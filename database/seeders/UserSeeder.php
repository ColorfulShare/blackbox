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
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'
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
            'binary_id' =>'1',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'
        ]);

        User::create([
            'firstname'=> 'alex',
            'lastname'=> Str::random(5),
            'username'=> 'alex',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);

        User::create([
            'firstname'=> 'Rafael',
            'lastname'=> Str::random(5),
            'username'=> 'rafael',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo1@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);
        User::create([
            'firstname'=> 'alexander',
            'lastname'=> Str::random(5),
            'username'=> 'alexander',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo2@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);

        User::create([
            'firstname'=> 'antonio',
            'lastname'=> Str::random(5),
            'username'=> 'antonio',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo3@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);
        User::create([
            'firstname'=> 'antony',
            'lastname'=> Str::random(5),
            'username'=> 'antony',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo4@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);
        User::create([
            'firstname'=> 'manuel',
            'lastname'=> Str::random(5),
            'username'=> 'manuel',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo5@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);

        User::create([
            'firstname'=> 'carlos',
            'lastname'=> Str::random(5),
            'username'=> 'manuel',
            'phone'=> '04121234567',
            'wallet'=> 'wallet',
            'email'=> 'correo6@gmail.com',
            'admin'=> '1',
            'password' => Hash::make('12345678'),
            'binary_id' =>'0',
            'referral_code'=>Str::random(7),
            'referral_admin_red_code'=>Str::random(7),
            'email_verified_at'=>'2021-11-17 15:46:20'

        ]);
    }


}
