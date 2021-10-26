<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function link(Request $request, $referralCode)
{
    if (!$request->hasCookie('referral')) {
        $cookie = cookie('referral', $referralCode, 60 * 24 * 7);

        return redirect('/')->withCookie($cookie);
    }

    return redirect('/');
}
}
