<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use App\Models\OrdenPurchase;
use App\Models\Wallet;
use App\Models\Log_rendimientos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class RendimientoController extends Controller
{
    /**
     * Lleva a la vista de los rendimientos pagados
     *
     * @return void
     */
    public function index()
    {
        $fecha = Carbon::now();
        $rendimientos = Log_rendimientos::orderBy('id', 'desc')->take(100)->get();
        return view('rendimientos.index', compact('rendimientos'));
    }

    public function savePorcentage(Request $request)
    {
        $validate = $request->validate([
            'porcentage' => ['required', 'numeric']
        ]);

        try {
            if ($validate) {
                DB::beginTransaction();
                $fecha = Carbon::now();
                $inversiones = Inversion::where('status', '=', 1)->get();
        
                $rangoporcentage = ($request->porcentage / 100);
                Log_rendimientos::create(['monto'=>$rangoporcentage]);
        
                    foreach($inversiones as $inversion){
                        
                        $fechaInversion = new Carbon($inversion->created_at);
                        if ($fechaInversion->diffInHours($fecha) >= 48) {
                            $actual = $inversion;
                            
                            $this->actualizarInversiones($inversion , $actual , $rangoporcentage);   
                        }
                    }

                DB::commit();
                
                return redirect()->back()->with('success', 'Rendimiento pagado con exito');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Rendimiento - SavePorcentage -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite actualizar el porcentege de comision
     *
     * @param object $inversion
     * @param object $actual
     * @param float $rangoporcentage
     * @return void
     */
    public function actualizarInversiones($inversion ,  $actual , $rangoporcentage ){
        if($inversion->status == 1){
            $inversion =  $inversion::find($inversion->id);
            if($actual->invested > $inversion->invested){
                $actual->invested = $actual->invested + $inversion->invested;
            }
            if(($inversion->progress + $rangoporcentage) >= 0.20){
                $inversion->progress = 0.20; 
            }else{
                $inversion->progress+= $rangoporcentage;
            }
            
            $inversion->gain = $inversion->invested * $rangoporcentage ;
            $inversion->gain =  $inversion->gain +  $actual->gain ;
    
            $concepto = 'Pago de rendimiento por '  .$rangoporcentage.'%';
            $this->preSaveWallet( $inversion, $concepto , $rangoporcentage);
            $inversion->save();
            return $inversion;
        }
     }
 
     /**
      * Arma el arreglo que se guardara en la billetera
      *
      * @param object $inversion
      * @param string $concepto
      * @return void
      */
     private function preSaveWallet( $inversion, string $concepto, $porcentaje)
     {
         $ordenId = OrdenPurchase::where( 'inversion_id','=' , $inversion->id )->first();
      
         $data = [
            'user_id' => $inversion->user_id,
            'amount' => $inversion->gain,
            'descripcion' => $concepto,
            'status' => 0,
            'inversion_id' => $inversion->id,
            'percentage' => $porcentaje
        ];
 
         //$wallet = Wallet::where('user_id',$data['user_id'])->first();
         return $this->saveWallet($data);
     }
 
     /**
      * Guarda la informacion en la wallet
      *
      * @param array $data
      * @param object $wallet
      * @return void
      */
     public function saveWallet($data)
     {
         /*
         if($wallet == null){
             $new_wallet = new Wallet();
             $new_wallet->user_id = $data['user_id'];
             $new_wallet->monto = $data['monto'];
             $new_wallet->descripcion = $data['descripcion'];
             $new_wallet->tipo_comision = $data['tipo_comision'];
             $new_wallet->referred_id = $data['referred_id'];
             $new_wallet->orden_purchase_id = $data['orden_purchase_id'];
             $wallet =  $new_wallet;
         }
         */
        $wallet = Wallet::create($data);
     }

}
