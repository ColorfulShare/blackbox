<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'phone',
        'countrie_id',
        'wallet',
        'email',
        'password',
        'token_google',
        'activar_2fact',
        'expired_status',
        'referred_id',
        'binary_id',
        'binary_side',
        'binary_side_register',
        'point_rank',
        'rank_id',
        'date_reset_points_binary',
        'not_payment_binary_point_direct',
        'referral_code',
        'referred_by',
        'referral_admin_red_code',
        'referred_red_by',
        'code_email',
        'code_email_date',
        'status',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'expired_status'
    ];
    
    public function inversiones()
    {
        return $this->hasMany('App\Models\Inversion', 'user_id');
    }

    public function wallets()
    {
        return $this->hasMany('App\Models\Wallet', 'user_id');
    }

    public static function getUniqueReferralCode()
    {
        do{
            $code = Str::random(7);
        }while (User::where('referral_code',$code)->exists());
        return $code;
    }

    public static function getUniqueAdminRedReferralCode(){
        do{
            $codeAdminRed = Str::random(7);
        }while(User::where('referral_admin_red_code',$codeAdminRed)->exists());
        return $codeAdminRed;
    }

    public function contadorExpiredStatus()
    {
        $fechaAntigua  = \Carbon\Carbon::now();
        $fechaReciente = $this->expired_status;

        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);

        return $cantidadDias;
    }

    public function saldoDisponible()
    {
        return $this->wallets()->where('status', 0)->sum('amount');
    }

    public function saldoDisponibleFormat()
    {
        return '$ '.number_format($this->saldoDisponible(), 2);
    }

    public function estado()
    {
        if($this->status == '0'){
            return "Inactivo";
        }elseif($this->status == '1'){
            return "Activo";
        }elseif($this->status == '2'){
            return "Eliminado";
        }
    }

    public function referidos()
    {
        return $this->hasMany('App\Models\User', 'referred_by');
    }

    public function refirio()
    {
        return $this->belongsTo('App\Models\User', 'referred_by');
    }

    public function inversionMasAlta()
    {
        return $this->inversiones->where('status', 1)->sortByDesc('id')->first();
        //->sortByDesc('invertido')
    }
 }
