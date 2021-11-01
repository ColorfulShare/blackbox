<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public $timestamps = true;
    
    protected $fillable = [
         'iduser','status', 'priority','issue','created_at', 'name', 'email' 
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }



}