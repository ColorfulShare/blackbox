<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','orden_purchases_id','invested', 'gain', 'capital',
        'status'
    ];

    public function orden()
    {
        return $this->belongsTo('App\Models\OrdenPurchases', 'orden_purchases_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
