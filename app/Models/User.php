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
        return $this->hasMany('App\Models\Inversion', 'iduser');
    }

    public function wallets()
    {
        return $this->hasMany('App\Models\Wallet', 'iduser');
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

    public function referido($id)
    {
        $referido = User::where('id', $id)->first();

        if ($referido == NULL) {
            return 'Sin Referidos';
        } else {
            return $referido->fullname;
        }
    }

    /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getWallet()
    {
        return $this->hasMany('App\Models\Wallet', 'iduser');
    }

    /**
     * Permite obtener todas la liquidaciones que tengo
     *
     * @return void
     */
    public function getLiquidate()
    {
        return $this->hasMany('App\Models\Liquidaction', 'iduser');
    }

    /**
     * Permite obtener las ordenes de servicio asociada a una categoria
     *
     * @return void 
     */
   

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($this, $token));
    }

    public function getUserInversiones()
    {
        return $this->hasMany('App\Models\Inversion', 'iduser');
    }

    public function inversionMasAlta()
    {
        return $this->getUserInversiones()->where('status', 1)->orderBy('invertido', 'desc')->first();
        //->sortByDesc('invertido')
    }

    public function montoInvertido()
    {
        $monto = 0;
        foreach ($this->getUserInversiones as $inversion) {
            if ($inversion->status == 1) {
                $monto += $inversion->invertido;
            }
        }
        return number_format($monto, 2);
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
        return $this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('monto');
    }

    public function gananciaActual()
    {
        if (isset($this->inversionMasAlta()->ganacia) && $this->inversionMasAlta()->ganacia != null) {
            return number_format($this->inversionMasAlta()->ganacia, 2);
        } else {
            return number_format(0, 2);
        }
    }


    public function fechaActivo()
    {
        if ($this->inversionMasAlta() != null) {
            return $this->inversionMasAlta()->created_at->format('Y-m-d');
        } else {
            return "";
        }
    }

    /**
     * Permite obtener de forma bonita el status de un usuario
     *
     * @return string
     */
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
            if ($disponible <> 250) {
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

    /**
     * Permite obtener todo el historial de rangos obtenidos
     *
     * @return void
     */
    public function getRanksRecords()
    {
        return $this->hasMany('App\Models\RankRecords', 'iduser');
    }

    public function feeRetiro()
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            if ($disponible <> 250) {
                $result = 0.05;
            }
        }
        return floatval($result * 100);
    }
}
