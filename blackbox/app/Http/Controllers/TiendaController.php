<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\OrdenPurchase;

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
        $user = Auth::user();
        $package = Package::findOrFail($request->idproduct);

        $orden = OrdenPurchase::create([
            'user_id' => $user->id,
            'amount' => $package->price,
            'fee' => 0
        ]);
        
        return view('shop.transaction', compact('user', 'orden'));
        
        /*
        $user->status = '1';
        $user->expired_status = Carbon::now()->addYear(1);
        $user->save();
        */
        return back()->with('success', 'Compra exitosa');
    }
}
