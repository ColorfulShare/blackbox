<?php

namespace App\Http\Controllers;

use App\Models\Liquidation;
use App\Models\LogLiquidation;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LiquidationController extends Controller
{

    public $walletController;

    function __construct()
    {
        $this->walletController = new WalletController();
    }


    public function withdraw()
    {
        $this->reversarRetiro30Min();
        return view('wallet.withdraw');
    }



    /**
     * Permite Enviar el codigo
    
     */
    public function sendCodeEmail($wallet): int
    {
        try {
            $this->reversarRetiro30Min();
            if (!session()->has('intentos_fallidos')) {
                session(['intentos_fallidos' => 1]);
            }
            $liquidation = Liquidation::where([
                ['user_id', '=', Auth::id()],
                ['status', '=', 0],
            ])->first();
            if ($liquidation != null) {
                return $liquidation->id;
            }

            $user = Auth::user();

            $comisiones = Wallet::where([
                ['user_id', '=', $user->id],
                ['status', '=', 0],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
            ])->get();

            $bruto = $comisiones->sum('amount');

            if ($bruto < 100) {
                return 0;
            }

            $feed = ($bruto * 0.05);
            $total = ($bruto - $feed);

            $arrayLiquidation = [
                'user_id' => $user->id,
                'total' => $total,
                'monto_bruto' => $bruto,
                'feed' => $feed,
                'hash',
                'wallet_used' => $wallet,
                'status' => 0,
                'code_correo' => Str::random(10),
                'fecha_code' => Carbon::now()
            ];
            $idLiquidation = $this->saveLiquidation($arrayLiquidation);

            $dataEmail = [
                'billetera' => $wallet,
                'total' => $total,
                'user' => $user->fullname,
                'code' => $arrayLiquidation['code_correo']
            ];

            Mail::send('mails.SendCodeRetiro', $dataEmail, function ($msj) use ($user) {
                $msj->subject('Codigo Retiro');
                $msj->to($user->email);
            });

            if (!empty($idLiquidation)) {
                $listComi = $comisiones->pluck('id');
                Wallet::whereIn('id', $listComi)->update([
                    'status' => 1,
                    'liquidation_id' => $idLiquidation
                ]);
            }
            return $idLiquidation;
        } catch (\Throwable $th) {
            Log::error('Liquidaction - sendCodeEmail -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite reversar los retiros que tienen mas de 30 min activos
     *
     * @return bool
     */
    public function reversarRetiro30Min(): bool
    {
        $liquidation = Liquidation::where([
            ['user_id', '=', Auth::id()],
            ['status', '=', 0]
        ])->first();
        $result = false;
        if ($liquidation != null) {
            $fechaActual = Carbon::now();
            $fechaCodeCorreo = new Carbon($liquidation->fecha_code);
            if ($fechaCodeCorreo->diffInMinutes($fechaActual) >= 30) {
                $this->reversarLiquidacion($liquidation->id, 'Tiempo limite de codigo sobrepasado');
                $result = true;
            }
        }
        return $result;
    }
}
