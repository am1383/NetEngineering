<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CpuSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('cpus')->insert([
            [
                'id' => 1,
                'brand' => 'Intel',
                'model' => 'i5-13400',
                'slug' => 'intel-i5-13400',
                'cores' => 10,
                'threads' => 16,
                'base_clock' => 2500,
                'boost_clock' => 4600,
                'socket' => 'LGA1700',
                'tdp' => 65,
                'price' => fake()->numberBetween(50_000, 3_000_000),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'brand' => 'Intel',
                'model' => 'i7-13700K',
                'slug' => 'intel-i7-13700k',
                'cores' => 16,
                'threads' => 24,
                'base_clock' => 3400,
                'boost_clock' => 5400,
                'socket' => 'LGA1700',
                'tdp' => 125,
                'price' => fake()->numberBetween(50_000, 3_000_000),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'brand' => 'AMD',
                'model' => 'Ryzen 7 7800X',
                'slug' => 'amd-ryzen-7-7800x',
                'cores' => 8,
                'threads' => 16,
                'base_clock' => 4200,
                'boost_clock' => 5000,
                'socket' => 'AM5',
                'tdp' => 120,
                'price' => fake()->numberBetween(50_000, 3_000_000),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
