<?php

namespace App\Http\Controllers;

use App\Models\Liquidation;
use App\Models\LogLiquidation;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiquidationController extends Controller
{
    public function withdraw()
    {
        $this->reversarRetiro30Min();
        return view('wallet.withdraw');
    }


    public function reversarRetiro30Min(): bool
    {
        $liquidation = Liquidation::where([
            ['iduser', '=', Auth::id()],
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

    public function reversarLiquidacion($idliquidation, $comentario)
    {
        $liquidacion = Liquidation::find($idliquidation);

        Wallet::where('liquidation_id', $idliquidation)->update([
            'status' => 0,
            'liquidation_id' => null,
        ]);

        LogLiquidation::create([
            'idliquidation' => $idliquidation,
            'comentario' => $comentario,
            'accion' => 'Reservada',

        ]);

        // $concepto = 'Liquidacion Reservada - Motivo: '.$comentario;
        // $arrayWallet =[
        //     'iduser' => $liquidacion->iduser,
        //     'orden_purchases_id' => null,
        //     'referred_id' => $liquidacion->iduser,
        //     'monto' => $liquidacion->monto_bruto,
        //     'descripcion' => $concepto,
        //     'status' => 3,
        //     'tipo_transaction' => 0,
        // ];

        // $this->walletController->saveWallet($arrayWallet);

        $liquidacion->status = 2;
        $liquidacion->save();
    }
}
