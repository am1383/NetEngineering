<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;
use Str;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Server::insert([
            [
                'slug' => 'ryzen-9-5900x',
                'name' => 'Server Number One',
                'ulid' => Str::ulid(),
                'cpu_id' => 1,
                'gpu_id' => 1,
                'ram_id' => 1,
                'storage' => 512,
                'os' => 'Windows',
                'price_per_hour' => 20000,
                'price_per_day' => 300000,
                'is_active' => true,
            ],
            [
                'slug' => 'ryzen-7-7800x3d',
                'name' => 'Server Number Two',
                'ulid' => Str::ulid(),
                'cpu_id' => 2,
                'gpu_id' => 2,
                'ram_id' => 2,
                'storage' => 1024,
                'os' => 'Linux',
                'price_per_hour' => 10000,
                'price_per_day' => 50000,
                'is_active' => true,
            ],
            [
                'slug' => 'intel-i9-13900k',
                'name' => 'Server Number Three',
                'ulid' => Str::ulid(),
                'cpu_id' => 1,
                'gpu_id' => 1,
                'ram_id' => 1,
                'storage' => 256,
                'os' => 'Windows',
                'price_per_hour' => 10000,
                'price_per_day' => 50000,
                'is_active' => true,
            ],
        ]);
    }
}
