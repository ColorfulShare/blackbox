<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLiquidation extends Model
{
    protected $fillable = [
        'idliquidation', 'comentario', 'accion'
    ];

    public function getLiquidation()
    {
        return $this->belongsTo('App\Models\Liquidation', 'idliquidation', 'id');
    }
}
