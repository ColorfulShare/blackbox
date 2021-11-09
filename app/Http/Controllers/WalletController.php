<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Liquidaction;



class WalletController extends Controller
{
    public function indexWallet()
    {

        $wallets = Auth::user()->getWallet->where('tipo_transaction', 0)->sortByDesc('id');

        $saldoDisponible = $wallets->where('status', 0)->sum('monto');
        return view('wallet.IndexWallet', compact('wallets', 'saldoDisponible'));
    }
}
