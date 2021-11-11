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
            $saldoDisponible = $wallets->where('status', 0)->sum('amount');
            return view('wallet.IndexWallet', compact('wallets', 'saldoDisponible'));
        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function saveWallet($data)
    {
        try {
            if ($data['user_id'] != 1) {
                if ($data['tipo_transaction'] == 1) {
                    $wallet = Wallet::create($data);
                    $saldoAcumulado = ($wallet->getWalletUser->wallet - $data['amount']);
                    $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                    $wallet->update(['amount' => -$data['amount']]);
                } else {
                    if ($data['orden_purchases_id'] != null) {
                        $check = Wallet::where([
                            ['user_id', '=', $data['user_id']],
                            ['orden_purchases_id', '=', $data['orden_purchases_id']],
                            ['referred_id', '=', $data['referred_id']]
                        ])->first();
                        if ($check == null) {
                            $wallet = Wallet::create($data);

                            $saldoAcumulado = ($wallet->getWalletUser->wallet + $data['amount']);
                            $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                            $this->aceleracion($data['user_id'], $data['referred_id'], $data['amount'], $data['descripcion']);
                        }
                    } else {
                        $wallet = Wallet::create($data);
                        $saldoAcumulado = ($wallet->getWalletUser->wallet + $data['amount']);
                        $wallet->getWalletUser->update(['wallet' => $saldoAcumulado]);
                        $this->aceleracion($data['user_id'], $data['referred_id'], $data['amount'], $data['descripcion']);
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::error('Wallet - saveWallet -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
