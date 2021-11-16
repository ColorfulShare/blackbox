<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';

    protected $fillable = [
         'id', 'name', 'file', 'type', 'status', 'created_at', 'updated_at' 
    ];

}