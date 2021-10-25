<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

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
        $user->status = '1';
        $user->expired_status = Carbon::now()->addYear(1);
        $user->save();

        return back()->with('success', 'Compra exitosa');
    }
}
