<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'percentage', 'descripcion',
        'status', 'inversion_id', 'referred_id', 'tipo_transaction'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function inversion()
    {
        return $this->belongsTo('App\Models\Inversion', 'inversion_id', 'id');
    }
    public function getWalletReferred()
    {
        return $this->belongsTo('App\Models\User', 'referred_id', 'id');
    }

    public function getLiquidation()
    {
        return $this->belongsTo('App\Models\Liquidation', 'liquidation_id', 'id');
    }
    public function getWalletUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function status()
    {
        if ($this->status == '0'){
            return "Esperando";
        }elseif($this->status == '1'){
            return "Aprobado";
        }elseif($this->status == '2'){
            return "Rechazado";
        }
    }
}
