<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_rendimientos extends Model
{
   protected $table = 'log_rendimientos';

   protected $fillable =['monto'];



    /**
     * Permite obtener al usuario de una Inversion
     *
     * @return void
     */
    public function getInversionesUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}

