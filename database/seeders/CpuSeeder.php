<?php

namespace Database\Seeders;

use App\Models\Cpu;
use Illuminate\Database\Seeder;

class CpuSeeder extends Seeder
{
    public function run(): void
    {
        Cpu::insert([
            [
                'brand' => 'Intel',
                'model' => 'i5-13400',
                'slug' => 'intel-i5-13400',
                'cores' => 10,
                'threads' => 16,
                'base_clock' => 2500,
                'boost_clock' => 4600,
                'socket' => 'LGA1700',
                'tdp' => 65,
                'price' => 3000000
            ],
            [
                'brand' => 'Intel',
                'model' => 'i7-13700K',
                'slug' => 'intel-i7-13700k',
                'cores' => 16,
                'threads' => 24,
                'base_clock' => 3400,
                'boost_clock' => 5400,
                'socket' => 'LGA1700',
                'tdp' => 125,
                'price' => 1000000
            ],
            [
                'brand' => 'AMD',
                'model' => 'Ryzen 7 7800X',
                'slug' => 'amd-ryzen-7-7800x',
                'cores' => 8,
                'threads' => 16,
                'base_clock' => 4200,
                'boost_clock' => 5000,
                'socket' => 'AM5',
                'tdp' => 120,
                'price' => 4000000
            ],
        ]);
    }
}
