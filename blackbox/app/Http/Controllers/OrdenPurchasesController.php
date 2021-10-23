<?php

namespace App\Http\Controllers;

use App\Models\OrdenPurchases;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrdenPurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrdenPurchases::all();

        return view('admin.orders.index', compact('orders'));
    }

    public function cambiar_status(Request $request)
    {
        try {
            DB::beginTransaction();

            $orden = OrdenPurchases::findOrFail($request->id);
            $orden->status = $request->status;
            $orden->save();

            // $user = User::findOrFail($orden->user_id);
            // $user->status = '1';
            // $user->save();

            DB::commit();

            return back()->with('success', 'Orden actualizada exitosamente');
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('OrdenPurchase - cambiar_status -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
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
     * @param  \App\Models\OrdenPurchases  $ordenPurchases
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenPurchases $ordenPurchases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenPurchases  $ordenPurchases
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenPurchases $ordenPurchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdenPurchases  $ordenPurchases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenPurchases $ordenPurchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenPurchases  $ordenPurchases
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenPurchases $ordenPurchases)
    {
        //
    }
}
