<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use App\Models\OrdenPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Tree;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Porcentaje;

class InversionController extends Controller
{
    use Tree;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $breadcrumbs = [['link' => "/inversiones", 'name' => "Lista"]];
        
        if (Auth::user()->admin == 1) {
            $inversiones = Inversion::orderBy('id', 'desc')->get();
        
        }else{
            $inversiones = Inversion::where('user_id', '=',Auth::id())->orderBy('id', 'desc')->get();
        }

        return view('inversiones.index', compact('inversiones', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\OrdenPurchase  $ordenpurchase //orden con la q se va a crear la inversion
     * @param  \Illuminate\Http\User  $user //usuario al q se le va a crear la inversion
     *  * @param  bol $comision //determina si generara o no generara comision
     * @return \Illuminate\Http\Response
     */
    public function store(OrdenPurchase $ordenpurchase, User $user, $comision = true)
    {
        try {

            DB::beginTransaction();
            $inversion = Inversion::create([
                'user_id'=> $ordenpurchase->user_id,
                //'package_id'=>$ordenpurchase->package_id,
                'orden_purchases_id'=>$ordenpurchase->id,
                'invested'=>$ordenpurchase->amount + $ordenpurchase->fee,
                'capital'=>$ordenpurchase->amount + $ordenpurchase->fee,
                'gain'=>0,
                'status'=>1
            ]);

            if($comision == true){
                $users = $this->getDataFather($user, 6);
                $this->bonoUnilevel($users, $user, $inversion->id);
            }
            
            DB::commit();

        }catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - store -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
     /**
     * Paga el bono unilevel hasta el nivel 6
     *
     * @param  Collection  $users lista de usuarios a pagar el bono
     * @param  User  $usuario usuario el cual produce el bono
     * @param  integer  $idInversion
     * @return \Illuminate\Http\Response
     */
    public function bonoUnilevel(Collection $users, $usuario , $idInversion=null)
    {
        foreach($users as $user){
            if($user->nivel == 1){
                $monto = 20;
            }elseif($user->nivel == 2){
                $monto = 14;
            }elseif($user->nivel == 3){
                $monto = 10;
            }elseif($user->nivel == 4){
                $monto = 5;
            }elseif($user->nivel == 5){
                $monto = 3;
            }elseif($user->nivel == 6){
                $monto = 1;
            }

            Wallet::create([
                'user_id' => $user->id,
                'amount' => $monto,
                'descripcion' => 'Bono unilevel nivel '.$user->nivel. ' del usuario '.$usuario->email,
                'status' => 0,
                //'inversion_id' => $idInversion
            ]);
        }

    }

    public function pagarRed(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach($request->except(['_token']) as $id){
                
                $user = User::findOrFail($id);

                if(isset($user)){
                    $users = $this->getDataFather($user, 6);
                    $this->bonoUnilevel($users, $user);
                }
            }
            $porcentaje = Porcentaje::orderBy('id', 'desc')->first();
            if(isset($porcentaje)){
                $porcentaje->update(['porcentaje' => 0]);
            }
            DB::commit();

            return back()->with('success', 'Red pagada exitosamente');
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('InversionController - pagarRed -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }
}
