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
use Carbon\Carbon;

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
                //'orden_purchases_id'=>$ordenpurchase->id,
                'invested'=>$ordenpurchase->amount,
                'capital'=>$ordenpurchase->amount,
                'gain'=>0,
                'status'=>1
            ]);

            $ordenpurchase->inversion_id = $inversion->id;
            $ordenpurchase->save();

            if($comision == true){
                $users = $this->getDataFather($user, 6);
                $this->bonoUnilevel($users, $user, $inversion->id);
            }

            //BONO DIRECTO
            
            if(isset($user->refirio) && $user->refirio->type == 'red'){
                $this->bonoDirecto($inversion, $user);
            }
            
            DB::commit();

        }catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - store -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

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
                'inversion_id' => $idInversion
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

    public function bonoContruccion()
    {
        try {
            DB::beginTransaction();

            $users = User::whereHas('refirio', function($user){
                $user->where('type', 'profesional');
            })->get();
        
            $inicioDelMes = Carbon::now()->subMonth(1)->startOfMonth();
            $finalDelMes = Carbon::now()->subMonth(1)->endOfMonth();
            
            foreach($users as $user){
                //wallets
                $wallets = $user->wallets->whereBetween('created_at', [$inicioDelMes, $finalDelMes]);
                
                foreach($wallets as $wallet){

                    Wallet::create([
                        'user_id' => $user->refirio->id,
                        'amount' => $wallet->amount * 0.10,
                        'descripcion' => 'Bono Construnccion del usuario '.$user->email,
                        'status' => 0,
                        'percentage' => 0.10,
                    ]);
                }
            }

            DB::commit();

            return 'listo';
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('InversionController - bonoContruccion -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function bonoDirecto(Inversion $inversion, User $user)
    {
        try {
            DB::beginTransaction();

            Wallet::create([
                'user_id' => $user->refirio->id,
                'amount' => $inversion->invested * 0.03,
                'descripcion' => 'Bono Directo del usuario '.$user->email,
                'inversion_id' => $inversion->id,
                'percentage' => 0.03,
                'status' => 0
            ]);

            DB::commit();
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('InversionController - bonoDirecto -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }
}
