<?php

namespace Database\Seeders;

use App\Models\Gpu;
use Illuminate\Database\Seeder;

class GpuSeeder extends Seeder
{
    public function run(): void
    {
        Gpu::insert([
            [
                'brand' => 'NVIDIA',
                'model' => 'RTX 3060',
                'slug' => 'nvidia-rtx-3060',
                'vram' => 12,
                'chipset' => 'RTX',
                'power' => 170,
                'price' => 2000000
            ],
            [
                'brand' => 'NVIDIA',
                'model' => 'RTX 4070',
                'slug' => 'nvidia-rtx-4070',
                'vram' => 12,
                'chipset' => 'RTX',
                'power' => 200,
                'price' => 700000
            ],
            [
                'brand' => 'AMD',
                'model' => 'RX 7800 XT',
                'slug' => 'amd-rx-7800-xt',
                'vram' => 16,
                'chipset' => 'RX',
                'power' => 263,
                'price' => 8000000
            ],
        ]);
    }
}
