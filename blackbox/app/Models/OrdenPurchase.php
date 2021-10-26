<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenPurchase extends Model
{
    use HasFactory;

    protected $table = 'orden_purchases';

    protected $fillable = [
        'user_id','amount', 'fee', 'comprobante',
        'status', 'package_id', 'hash', 'type_payment'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function inversion()
    {
        return $this->hasOne('App\Models\Inversion', 'orden_purchases_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package', 'package_id', 'id');
    }
}