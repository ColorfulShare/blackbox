<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'token_google',
        'activar_2fact',
        'expired_status',
        'referral_code',
        'referred_by'
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

    public static function getUniqueReferralCode()
    {
        do{
            $code = Str::random(7);
        }while (User::where('referral_code',$code)->exists());
        return $code;
    }

    private function getReferredBy(){
        $referralCode = Cookie::get('referral');
        if($referralCode){
            return User::where('referral_code', $referralCode)->value('id');

        }
        return null;
    }

}
