<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\Porcentaje;

class UserController extends Controller
{
    public function checkEmail($id)
    {
        $id = Crypt::decryptString($id);
        User::where('id', $id)->update(['email_verified_at' => Carbon::now()]);
        return redirect()->route('login')->with('msj-success', 'Correo Electronico confirmado');
    }

    public function cambiarPorcentaje(Request $request)
    {
        $porcentaje = $request->porcentaje / 100;
        
        $porcentajeUtilidad = Porcentaje::orderBy('id', 'desc')->first();

        if($porcentajeUtilidad == null){
            Porcentaje::create(['porcentaje' => $porcentaje]);
        }else{
            $porcentajeUtilidad->update(['porcentaje' => ($porcentajeUtilidad->porcentaje + $porcentaje)]);
        }

        return redirect()->back()->with('msj-success', 'Porcentaje actualizado correctamente');
    }
}
