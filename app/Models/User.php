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


    public function saldoDisponibleFormat()
    {
        return '$ ' . number_format($this->saldoDisponible(), 2);
    }



    public function saldoDisponible()
    {
        return number_format($this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('monto'), 2);
    }

    /**
     * muestra el saldo disponible en numeros
     *
     * @return float
     */
    public function saldoDisponibleNumber(): float
    {
        return $this->wallets->where('status', 0)->where('tipo_transaction', 0)->sum('monto');
    }

    public function gananciaActual()
    {
        if (isset($this->inversionMasAlta()->gain) && $this->inversionMasAlta()->gain != null) {
            return number_format($this->inversionMasAlta()->gain, 2);
        } else {
            return number_format(0, 2);
        }
    }


    /**
     * Permite obtener el fee de los retiros
     *
     * @return float
     */
    public function getFeeWithdraw(): float
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            if ($disponible <> 100) {
                $result = ($disponible * 0.05);
            }
        }
        return floatval($result);
    }

    /**
     * Obtiene el total a retirar de cada usuario
     *
     * @return float
     */
    public function totalARetirar(): float
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            $result = ($disponible - $this->getFeeWithdraw());
        }
        return floatval($result);
    }

    public function feeRetiro()
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            if ($disponible <> 100) {
                $result = 0.05;
            }
        }
        return floatval($result * 100);
    }
}
