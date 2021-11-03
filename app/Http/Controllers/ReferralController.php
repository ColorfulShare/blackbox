<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
