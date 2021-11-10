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
use App\Models\Wallet;

class WalletController extends Controller
{
    public function indexWallet()
    {
        try {
            $wallets = Auth::user()->getWallet->where('tipo_transaction', 0)->sortByDesc('id');
            $saldoDisponible = $wallets->where('status', 0)->sum('monto');
            return view('wallet.IndexWallet', compact('wallets', 'saldoDisponible'));
        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function saveWallet($data)
    {
        try {
            if ($data['iduser'] != 1) {
                if ($data['tipo_transaction'] == 1) {
                    $wallet = Wallet::create($data);
                    $saldoAcumulado = ($wallet->getWalletUser->wallet - $data['monto']);
                    $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                    $wallet->update(['monto' => -$data['monto']]);
                } else {
                    if ($data['orden_purchases_id'] != null) {
                        $check = Wallet::where([
                            ['iduser', '=', $data['iduser']],
                            ['orden_purchases_id', '=', $data['orden_purchases_id']],
                            ['referred_id', '=', $data['referred_id']]
                        ])->first();
                        if ($check == null) {
                            $wallet = Wallet::create($data);
                            // dd($wallet->getWalletUser);
                            $saldoAcumulado = ($wallet->getWalletUser->wallet + $data['monto']);
                            $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                            $this->aceleracion($data['iduser'], $data['referred_id'], $data['monto'], $data['descripcion']);
                        }
                    } else {
                        $wallet = Wallet::create($data);
                        $saldoAcumulado = ($wallet->getWalletUser->wallet + $data['monto']);
                        $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                        $this->aceleracion($data['iduser'], $data['referred_id'], $data['monto'], $data['descripcion']);
                    }
                    // $wallet->update(['balance' => $saldoAcumulado]);
                }
            }
        } catch (\Throwable $th) {
            Log::error('Wallet - saveWallet -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
