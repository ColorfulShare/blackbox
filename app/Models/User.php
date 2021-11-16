<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MyResetPassword;


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
    
    public function fullName()
    {
        return $this->firstname . ' '. $this->lastname;
    }

    public function inversiones()
    {
        return $this->hasMany('App\Models\Inversion', 'user_id');
    }

    public function wallets()
    {
        return $this->hasMany('App\Models\Wallet', 'user_id');
    }


    public function contadorExpiredStatus()
    {
        $fechaAntigua  = \Carbon\Carbon::now();
        $fechaReciente = $this->expired_status;

        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);

        return $cantidadDias;
    }



    public function saldoDisponibleFormat()
    {
        return '$ ' . number_format($this->saldoDisponible(), 2);
    }

    public function referidos()
    {
        return $this->hasMany('App\Models\User', 'referred_by');
    }

    public function estado()
    {
        if ($this->status == '0') {
            return "Inactivo";
        } elseif ($this->status == '1') {
            return "Activo";
        } elseif ($this->status == '2') {
            return "Eliminado";
        }
    }

    public function refirio()
    {
        return $this->belongsTo('App\Models\User', 'referred_by');
    }

    public static function getUniqueReferralCode()
    {
        do {
            $code = Str::random(7);
        } while (User::where('referral_code', $code)->exists());
        return $code;
    }

    public static function getUniqueAdminRedReferralCode()
    {
        do {
            $codeAdminRed = Str::random(7);
        } while (User::where('referral_admin_red_code', $codeAdminRed)->exists());
        return $codeAdminRed;
    }




    /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getWallet()
    {
        return $this->hasMany('App\Models\Wallet', 'user_id');
    }

    /**
     * Permite obtener todas la liquidaciones que tengo
     *
     * @return void
     */
    public function getLiquidate()
    {
        return $this->hasMany('App\Models\Liquidation', 'user_id');
    }

    public function montoInvertido()
    {
        $monto = 0;
        foreach ($this->inversiones as $inversion) {
            if ($inversion->status == 1) {
                $monto += $inversion->invertido;
            }
        }
        return number_format($monto, 2);
    }


    public function saldoDisponible()
    {
        return number_format($this->wallets->where('status', 0)->sum('amount'), 2);
    }

    /**
     * muestra el saldo disponible en numeros
     *
     * @return float
     */
    public function saldoDisponibleNumber(): float
    {
        return $this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount');
    }

    public function inversionMasAlta()
    {
        return $this->inversiones->where('status', 1)->sortByDesc('id')->first();
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

    public function getStatus(): string
    {
        $estado = 'Inactivo';
        if ($this->status == '1') {
            $estado = 'Activo';
        } elseif ($this->status == '1') {
            $estado = 'Eliminado';
        }
        return $estado;
    }


    public function fechaActivo()
    {
        if ($this->inversionMasAlta() != null) {
            return $this->inversionMasAlta()->created_at->format('Y-m-d');
        } else {
            return "";
        }
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
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }


}
