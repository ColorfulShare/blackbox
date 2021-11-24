<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Traits\Tree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class ReferralController extends Controller
{
    use Tree;

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


    public function buscar()
    {
        return view('referidos.buscar');    
    }

    public function listReferidos(Request $request)
    {
        $user = User::findOrFail($request->id);
        $referidos = $this->getChildrens($user, new Collection);

        return view('referidos.index' , compact('referidos'));
    }
}
