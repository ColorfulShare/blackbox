<?php

namespace App\Http\Controllers;

use App\Models\OrdenPurchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Notifications\userActivacionExitosa;
use App\Notifications\userActivacionRechazada;
use Carbon\Carbon;
use App\Http\Controllers\InversionController;
use Illuminate\Support\Facades\Auth;

class OrdenPurchasesController extends Controller
{


    public function __construct()
    {
        $this->inversionController = new InversionController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrdenPurchase::orderBy('id', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function cambiar_status(Request $request)
    {
        try {
            DB::beginTransaction();

            $orden = OrdenPurchase::findOrFail($request->id);
            $orden->status = $request->status;
            $orden->save();
            $user = User::findOrFail($orden->user_id);
            
            if($request->status == '2'){
                $user->status = '1';
                $user->expired_status = Carbon::now()->addYear(1);
                $user->save();
            
                $this->inversionController->store($orden, $user);

                $user->notify(new userActivacionExitosa());

            }elseif($request->status == '3'){

                $user->notify(new userActivacionRechazada());
            }
        
            DB::commit();

            return back()->with('success', 'Orden actualizada exitosamente');
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('OrdenPurchase - cambiar_status -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdenPurchase  $OrdenPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenPurchase $OrdenPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenPurchase  $OrdenPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenPurchase $OrdenPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdenPurchase  $OrdenPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenPurchase $OrdenPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenPurchase  $OrdenPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenPurchase $OrdenPurchase)
    {
        //
    }
}
