<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    use HasFactory;

    protected $fillable = [
	    'user_id','level','amount','status',
	    
    ];

    public function getUser()
    {
    	return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function referred()
    {
    	return $this->hasOne('App\Models\User', 'user_id', 'referred_id');
    }
}
