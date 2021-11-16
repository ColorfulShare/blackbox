<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use App\Models\Porcentaje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Package;
use App\Http\Controllers\InversionController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Notifications\userActivacionExitosa;
use App\Models\OrdenPurchase;
use App\Http\Traits\Tree;
use Illuminate\Database\Eloquent\Collection;

class UserController extends Controller
{
    use Tree;
    
    public function __construct()
    {
        $this->inversionController = new InversionController();
    }

    public function checkEmail($id)
    {
        $id = Crypt::decryptString($id);
        User::where('id', $id)->update(['email_verified_at' => Carbon::now()]);
        return redirect()->route('login')->with('alert-success', 'Correo Electronico confirmado');
    }

    public function sendCodeEmail(){
        $id = Auth::user()->id;

        $user = User::find($id);

        $codigo = rand(10,1000000);
        $user->code_email = $codigo;
        $user->code_email_date = Carbon::now();

        $dataEmail = [
            'user' => $user->fullname(),
            'code' => $user->code_email
        ];


        $user->save();



        Mail::send('mails.SendCodeEmail', ['data' => $dataEmail], function ($msj) use ($user)
        {
            $msj->subject('Codigo Email');
            $msj->to($user->email);
        });

    }

    public function verificationEmail(){


        $this->sendCodeEmail();

        return view('verification');
    }

    public function verifyAccount(Request $request, User $user){

        $fields = [
            "code" => ['required', 'numeric'],
        ];

        $msj = [
            'code.required' => 'El código es requerido.',
            'code.numeric' => 'El código enviado es numérico'
        ];

        $this->validate($request, $fields, $msj);

        if($request->code == $user->code_email){
            $minutos = Carbon::now()->diffInMinutes($user->code_email_date);

            if($minutos < 30){
                $user->email_verified_at = Carbon::now();
                $user->save();

                return redirect()->route('dashboard')->with('alert-success', 'Tu usuario ha sido verificado con éxito.');
            }else{
                return redirect()->back()->with('alert-danger', 'El código está caducado, se ha enviado un nuevo código.');
            }
        }else{
            return redirect()->route('user.verification.email')->with('alert-danger', 'El código ingresado no es válido. Por favor revise su correo.');
        }

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
    
    public function listUser()
    {

       $user = User::orderBy('id', 'desc')->get();

        return view('user.list-users', compact('user'));
    }

    public function activacion()
    {
        $user = User::whereDoesntHave('inversiones',function($inversion){
            $inversion->where('status','=' ,1);
        })->get();
        
        $paquetes = Package::all();

        return view('user.activacion', compact('user', 'paquetes'));
    }

    public function activar(Request $request)
    {
        try {
            DB::beginTransaction();
            $package = Package::find($request->paquete);

            $user = User::findOrFail($request->id);

            $orden = OrdenPurchase::create([
                'user_id' => $user->id,
                'amount' => $package->price,
                'fee' => 0,
                'package_id' => $package->id,
                'status' => '2'
            ]);

            $user->status = '1';
            $user->expired_status = Carbon::now()->addYear(1);
            $user->save();

            if(isset($request->comision)){
                $this->inversionController->store($orden, $user);
            }else{
                $this->inversionController->store($orden, $user, false);
            }

            $user->notify(new userActivacionExitosa());
            DB::commit();

            return back()->with('success', 'Usuario activado exitosamente');
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('UserController - activar -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function referidos(Request $request)
    {
        try {
            $referidos = $this->getChildrens(Auth::user(), new Collection);

            return view('user.list-referidos', compact('referidos'));
        } catch (\Throwable $th) {

            Log::error('UserController - referidos -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }
}
