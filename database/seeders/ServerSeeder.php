<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Server::insert([
            [
                'cpu' => 'Ryzen 9 5900X',
                'gpu' => 'RTX 4090',
                'ram' => 64,
                'storage' => 512,
                'os' => 'Windows 11',
                'price_per_hour' => 20000,
                'price_per_day' => 300000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpu' => 'Ryzen 7 7800X3D',
                'gpu' => 'RTX 4080',
                'ram' => 32,
                'storage' => 512,
                'os' => 'Ubuntu 22.04',
                'price_per_hour' => 15000,
                'price_per_day' => 220000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cpu' => 'Intel i9 13900K',
                'gpu' => 'RTX 3080',
                'ram' => 32,
                'storage' => 256,
                'os' => 'Windows 10',
                'price_per_hour' => 12000,
                'price_per_day' => 180000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
