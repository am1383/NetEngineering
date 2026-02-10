<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RamSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('rams')->insert([
            [
                'id' => 1,
                'brand' => 'Corsair',
                'model' => 'Vengeance LPX',
                'capacity' => 16,
                'frequency' => 3200,
                'type' => 'DDR4',
                'slots' => 2,
                'price' => 4500000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'brand' => 'G.Skill',
                'model' => 'Trident Z RGB',
                'capacity' => 32,
                'frequency' => 3600,
                'type' => 'DDR4',
                'slots' => 2,
                'price' => 8500000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'brand' => 'Kingston',
                'model' => 'Fury Beast',
                'capacity' => 32,
                'frequency' => 5600,
                'type' => 'DDR5',
                'slots' => 2,
                'price' => 12000000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
