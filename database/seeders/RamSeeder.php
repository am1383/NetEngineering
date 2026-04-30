<?php

namespace Database\Seeders;

use App\Models\Ram;
use Illuminate\Database\Seeder;

class RamSeeder extends Seeder
{
    public function run(): void
    {
        Ram::insert([
            [
                'brand' => 'Corsair',
                'model' => 'Vengeance LPX',
                'capacity' => 16,
                'frequency' => 3200,
                'type' => 'DDR4',
                'slots' => 2,
                'price' => 3000000
            ],
            [
                'brand' => 'G.Skill',
                'model' => 'Trident Z RGB',
                'capacity' => 32,
                'frequency' => 3600,
                'type' => 'DDR4',
                'slots' => 2,
                'price' => 2000000
            ],
            [
                'brand' => 'Kingston',
                'model' => 'Fury Beast',
                'capacity' => 32,
                'frequency' => 5600,
                'type' => 'DDR5',
                'slots' => 2,
                'price' => 1000000
            ],
        ]);
    }
}
