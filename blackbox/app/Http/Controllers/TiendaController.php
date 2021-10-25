<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\OrdenPurchase;
use Illuminate\Support\Facades\Storage;

class TiendaController extends Controller
{
    //
    public function index(Request $request)
    {
        // title
        View::share('titleg', 'Tienda');

        $packages = Package::orderBy('price', 'desc')->paginate();

        return view('shop.index', compact('packages'));
    }

    public function proccess(Request $request)
    {
        try {
            $user = Auth::user();
            $package = Package::findOrFail($request->idproduct);

            $orden = OrdenPurchase::create([
                'user_id' => $user->id,
                'amount' => $package->price,
                'fee' => 0,
                'package_id' => $package->id
            ]);
            
            return view('shop.transaction', compact('user', 'orden'));
        } catch (\Throwable $th) {
            Log::error('TiendaController - proccess -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
        
        /*
        $user->expired_status = Carbon::now()->addYear(1);
        $user->save();
        */
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'orden' => 'required',
            'hash' => 'required',
            'comprobante' => 'required|mimes:jpg,jpeg,png',
            'type_payment' => 'required'
        ]);
    
        try {
            if($validate){
                $orden = OrdenPurchase::find($request->orden);
                $orden->hash = $request->hash;
                $orden->status = '1';
                $orden->type_payment = $request->type_payment;

                if ($request->hasFile('comprobante')) {
                    $user = Auth::user();
                    $file = $request->file('comprobante');
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('storage') .'/'. $user->id.'/comprobante', $name);
                    $orden->comprobante = $name;
            
                }

                $orden->save();

                return redirect('/')->with('success', 'orden actualizada exitosamente');
            }

        } catch (\Throwable $th) {
            Log::error('TiendaController - store -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }
}
