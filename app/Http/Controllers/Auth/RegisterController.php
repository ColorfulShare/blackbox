<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Crypt;
//use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        try{
            return Validator::make($data, [
                'g-recaptcha-response' => 'recaptcha',
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255'],
                'countrie_id' => ['required'],
                'terms' => ['required'],
                'phone' => ['required'],
                'wallet' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }catch (\throwable $th){
            dd($th);
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $binary_side = '';
        $binary_id = 0;
        if (!empty($data['referred_id'])) {
            $userR = User::find($data['referred_id']);

            //s$binary_id = $this->treeController->getPosition($data['referred_id'], $userR->binary_side_register);
            $binary_side = $userR->binary_side_register;
        }
        $billetera = [
            'activa' => 'USDTTR20',
            'USDTTR20' => $data['wallet'],
            'BTC' => ''
        ];

        $user = User::create([


            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'countrie_id' => $data['countrie_id'],
            'wallet' => json_encode($billetera),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'referral_code' => User::getUniqueReferralCode(),
            'referred_by' => $this->getReferredBy(),
            'referral_admin_red_code'=>User::getUniqueAdminRedReferralCode(),
            'referred_red_by'=> $this->getReferredAdmiBy(),
        ]);

        /* $encriptado = Crypt::encryptString($user->id);
        $ruta = route('checkemail', $encriptado);

        Mail::send('mails.checkemail', ['ruta' => $ruta], function($message) use ($user) {
            $message->subject('Bienvenido a Blackbox');
            $message->to($user->email);
        }); */

        /* $id = Auth::User()->id;

        $user = User::find()->id; */
        /* $codigo = rand(10,1000000);
        $user->code_email = $codigo;
        $user->code_email_date = Carbon::now();

        $dataEmail = [
            'user' => $user->fullname,
            'code' => $user->code_email
        ];

        $user->save();

        Mail::send('mails.SendCodeEmail', ['data' => $dataEmail], function ($msj) use ($user)
        {
            $msj->subject('Codigo Email');
            $msj->to($user->email);
        }); */

        return $user;
    }

    // Register
    public function showRegistrationForm()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/auth/register', [
        'pageConfigs' => $pageConfigs
        ]);
    }

    private function getReferredBy(){
        $referralCode = Cookie::get('referral');
        if($referralCode){
            return User::where('referral_code', $referralCode)->value('id');

        }
        return null;
    }

    private function getReferredAdmiBy(){
        $referral_admin_red_code = Cookie::get('referralAdminRed');
        if($referral_admin_red_code){
            return User::where('referral_admin_red_code', $referral_admin_red_code)->value('id');

        }
        return null;
    }
}