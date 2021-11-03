<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Package::create([
            'name' => 'Paquete 100',
            'price' => 100,
            'status' => '1',
        ]);
    }
}
