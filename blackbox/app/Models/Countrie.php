<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{
    protected $fillable = [
        'name', 'slug', 'phone_prefix', 'status'
    ];

    use HasFactory;
    
    public function bandera()
    {
        return asset('assets/img/banderas/'.$this->slug.'.png');
    }
}
