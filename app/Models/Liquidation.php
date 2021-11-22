<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidation extends Model
{
    protected $fillable = [
        'user_id', 'total', 'monto_bruto', 'feed', 'hash',
        'wallet_used', 'status'
    ];

    public function getUserLiquidation()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Permite obtener la informacion de obtener los comentarios sobre la liquidacion
     *
     * @return void
     */
    public function getLogLiquidation()
    {
        return $this->hasMany('App\Models\LogLiquidation', 'idliquidation');
    }
}
