<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;


class UserController extends Controller
{
    public function checkEmail($id)
    {
        $id = Crypt::decryptString($id);
        User::where('id', $id)->update(['email_verified_at' => Carbon::now()]);
        return redirect()->route('login')->with('msj-success', 'Correo Electronico confirmado');
    }
}
