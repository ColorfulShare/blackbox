<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function link(Request $request, $referralCode)
{
    if (!$request->hasCookie('referral')) {
        $cookie = cookie('referral', $referralCode, 60 * 24 * 7);

        return redirect('/register')->withCookie($cookie);
    }

    return redirect('/register');
}

public function linkAdminRed(Request $request, $referral_admin_red_code)
    {
    if (!$request->hasCookie('referralAdminRed')) {
        $cookie = cookie('referralAdminRed', $referral_admin_red_code, 60 * 24 * 7);

        return redirect('/register')->withCookie($cookie);
    }

    return redirect('/register');
    }


    public function referidos(){
        $id = Auth::user()->id;
        $referido = User::all()->take(10);

        return view('referidos.index' , compact('referido'));
    }
}
