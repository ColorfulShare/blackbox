<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'iduser', 'referred_id', 'orden_purchases_id', 'liquidation_id', 'monto',
        'descripcion', 'status', 'tipo_transaction',
        'liquidado'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }

    public function inversion()
    {
        return $this->belongsTo('App\Models\Inversion', 'inversion_id', 'id');
    }


    public function getWalletComisiones()
    {
        return $this->belongsTo('App\Models\OrdenPurchases', 'orden_purchases_id', 'id');
    }

    /**
     * Permite obtener al usuario de una comision
     *
     * @return void
     */
    public function getWalletUser()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }

    /**
     * Permite obtener al referido de una comision
     *
     * @return void
     */
    public function getWalletReferred()
    {
        return $this->belongsTo('App\Models\User', 'referred_id', 'id');
    }

    public function getLiquidation()
    {
        return $this->belongsTo('App\Models\Liquidaction', 'liquidation_id', 'id');
    }
}
