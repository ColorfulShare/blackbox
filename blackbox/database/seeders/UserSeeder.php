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
            'firstname'=> 'admin',
            'lastname'=> Str::random(5),
            'username'=> 'admin',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'admin@blackbox.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'referred_id' => 0,
            'binary_id' =>'0'

        ]);

        User::create([
            'firstname'=> 'luis',
            'lastname'=> Str::random(5),
            'username'=> 'luis',
            'phone'=> '04241234567',
            'wallet'=> 'walletwallet',
            'email'=> 'luisalbertobri16@gmail.com',
            'admin'=> '0',
            'password' => Hash::make('12345678'),
            'referred_id' => 1,
            'binary_id' =>'1'

        ]);
    }
}
