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
        'code_email_date'
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

    public static function getUniqueAdminRedReferralCode(){
        do{
            $codeAdminRed = Str::random(7);
        }while(User::where('referral_admin_red_code',$codeAdminRed)->exists());
        return $codeAdminRed;
    }

 }
