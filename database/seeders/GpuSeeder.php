<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GpuSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('gpus')->insert([
            [
                'id' => 1,
                'brand' => 'NVIDIA',
                'model' => 'RTX 3060',
                'slug' => 'nvidia-rtx-3060',
                'vram' => 12,
                'chipset' => 'RTX',
                'power' => 170,
                'price' => 22000000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'brand' => 'NVIDIA',
                'model' => 'RTX 4070',
                'slug' => 'nvidia-rtx-4070',
                'vram' => 12,
                'chipset' => 'RTX',
                'power' => 200,
                'price' => 38000000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'brand' => 'AMD',
                'model' => 'RX 7800 XT',
                'slug' => 'amd-rx-7800-xt',
                'vram' => 16,
                'chipset' => 'RX',
                'power' => 263,
                'price' => 34000000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
