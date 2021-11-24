<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $fillable = [
         'id', 'title', 'banner', 'status', 'created_at', 'updated_at' 
    ];

}