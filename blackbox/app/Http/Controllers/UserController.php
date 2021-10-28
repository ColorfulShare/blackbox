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
            if($porcentaje > 0.20){
                Porcentaje::create(['porcentaje' => 0.20]);
            }else{
                Porcentaje::create(['porcentaje' => $porcentaje]);
            }
            
        }else{
            $suma = $porcentajeUtilidad->porcentaje + $porcentaje;
            if($porcentaje > 0.20){
                $porcentajeUtilidad->update(['porcentaje' => 0.20]);
            }else{
                $porcentajeUtilidad->update(['porcentaje' => $suma]);
            }
            
        }

        return redirect()->back()->with('msj-success', 'Porcentaje actualizado correctamente');
    }
}
