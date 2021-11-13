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
        $this->doubleAuthController = new DoubleAutenticationController();
    }

    public function withdraw()
    {
        $this->reversarRetiro30Min();
        return view('wallet.withdraw');
    }

    /**
     * Permite procesar las liquidaciones
     *
     * @param integer $iduser -  id del usuario
     * @param array $listComision - comisiones a procesar si son selecionada
     * @return integer
     */
    public function generarLiquidation(int $iduser, array $listComision): int
    {
        try {
            $user = User::find($iduser);
            $comisiones = collect();

            if ($listComision == []) {
                $comisiones = Wallet::where([
                    ['user_id', '=', $iduser],
                    ['status', '=', 0],
                    ['tipo_transaction', '=', 0],
                ])->get();
            } else {
                $comisiones = Wallet::whereIn('id', $listComision)->get();
            }

            $bruto = $comisiones->sum('amount');
            if ($bruto < 50) {
                return 0; // Esta por debajo del limite diario
            }
            $feed = ($bruto * 0.05);
            $total = ($bruto - $feed);

            $arrayLiquidation = [
                'user_id' => $iduser,
                'total' => $total,
                'monto_bruto' => $bruto,
                'feed' => $feed,
                'hash',
                'wallet_used' => $user->type_wallet . ' - ' . $user->wallet_address,
                'status' => 0,
            ];
            $idLiquidation = $this->saveLiquidation($arrayLiquidation);

            if (!empty($idLiquidation)) {
                $listComi = $comisiones->pluck('id');
                Wallet::whereIn('id', $listComi)->update([
                    'status' => 1,
                    'liquidation_id' => $idLiquidation
                ]);
            }
            return 1; // Liquidacion exitosa
        } catch (\Throwable $th) {
            Log::error('Liquidaction - generarLiquidation -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite guardar las liquidaciones y devuelve el id de la misma
     *
     * @param array $data
     * @return integer
     */
    public function saveLiquidation(array $data): int
    {
        $liquidacion = Liquidation::create($data);
        return $liquidacion->id;
    }

    /**
     * Permite elegir que opcion hacer con las liquidaciones
     *
     * @param Request $request
     * @return void
     */
    public function procesarLiquidacion(Request $request)
    {
        if ($request->action == 'aproved') {
            $validate = $request->validate([
                'google_code' => ['required', 'numeric'],
                'correo_code' => ['required'],
                'wallet' => ['required']
            ]);
        } else {
            $validate = $request->validate([
                'comentario' => ['required'],
                'google_code' => ['required', 'numeric'],
                'correo_code' => ['required'],
            ]);
        }
        try {
            if ($validate) {

                $idliquidation = $request->idliquidation;
                $liquidation = Liquidation::find($idliquidation);
                $accion = 'No Procesada';

                if ($this->reversarRetiro30Min()) {
                    return redirect()->back()->with('msj-danger', 'El tiempo limite fue excedido');
                }

                if (session()->has('intentos_fallidos')) {

                    if (session('intentos_fallidos') >= 3) {
                        session()->forget('intentos_fallidos');
                        $request->comentario = 'Demasiados Intento Fallido con los codigo';
                        $accion = 'Reversada';
                        $this->reversarLiquidacion($idliquidation, $request->comentario);
                    }
                }

                //Verifica si los codigo esta bien

                if (!$this->doubleAuthController->checkCode($liquidation->iduser, $request->google_code) && $liquidation->code_correo != $request->correo_code && session()->has('intentos_fallidos')) {
                    session(['intentos_fallidos' => (session('intentos_fallidos') + 1)]);
                    return redirect()->back()->with('msj-danger', 'La Liquidacion fue ' . $accion . ' con exito, Codigos incorrectos');
                }

                $accion = 'No Procesada';
                if (!isset($request->fullname) && !isset($request->iduser) && !isset($request->total)) {
                    $this->aprovarLiquidacion($idliquidation, '', '');

                    $accion = 'Aprobada';
                    $request->comentario = '';

                    $fullname = auth()->user()->fullname;

                    $iduser = auth()->user()->id;
                    $total = $liquidation->total;
                } else {
                    $fullname = $request->fullname;
                    $iduser = $request->iduser;
                    $total = str_replace(',', '.', str_replace('.', '', $request->total));
                    $total = round($total, 2);

                    if ($request->action == 'reverse') {
                        $accion = 'Reversada';
                        $this->reversarLiquidacion($idliquidation, $request->comentario);
                    } elseif ($request->action == 'aproved') {
                        $accion = 'Aprobada';
                        $this->aprovarLiquidacion($idliquidation, $request->hash, $request->comentario);
                    }
                }


                if ($accion != 'No Procesada') {
                    $arrayLog = [
                        'idliquidation' => $idliquidation,
                        'comentario' => $request->comentario,
                        'accion' => $accion
                    ];
                    DB::table('log_liquidations')->insert($arrayLog);
                }

                $concepto = 'Liquidacion del usuario ' . $fullname . ' por un monto de ' . $total;
                $referred_id = User::find($iduser)->referred_id;
                $arrayWallet = [
                    'user_id' => $iduser,
                    'referred_id' => $referred_id,
                    'amount' =>  $total,
                    'descripcion' => $concepto,
                    'status' => 0,
                    'tipo_transaction' => 1,
                ];
                // dd($arrayWallet);
                $this->walletController->saveWallet($arrayWallet);

                return redirect()->back()->with('msj-success', 'La Liquidacion fue ' . $accion . ' con exito');
            }
        } catch (\Throwable $th) {
            Log::error('Liquidaction - saveLiquidation -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite aprobar las liquidaciones
     *
     * @param integer $idliquidation
     * @param string $hash
     * @return void
     */
    public function aprovarLiquidacion($idliquidation, $hash, $comentario)
    {
        Liquidation::where('id', $idliquidation)->update([
            'status' => 1,
            'hash' => $hash
        ]);

        LogLiquidation::create([
            'idliquidation' => $idliquidation,
            'comentario' => $comentario,
            'accion' => 'Aprovada',
        ]);

        Wallet::where('liquidation_id', $idliquidation)->update(['liquidado' => 1]);
    }

    /**
     * Permite procesar reversiones del sistema
     *
     * @param integer $idliquidation
     * @param string $comentario
     * @return void
     */
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


        $liquidacion->status = 2;
        $liquidacion->save();
    }


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

            if ($bruto < 25) {
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
