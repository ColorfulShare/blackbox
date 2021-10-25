<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=> 'admin',
            'lastname'=> Str::random(5),
            'email'=> 'admin@blackbox.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),

        ]);

        User::create([
            'name'=> 'luis',
            'lastname'=> Str::random(5),
            'email'=> 'luisalbertobri16@gmail.com',
            'admin'=> '0',
            'password' => Hash::make('12345678'),

        ]);
    }
}
