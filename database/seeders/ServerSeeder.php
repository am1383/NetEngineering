<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Server::insert([
            [
                'slug' => 'ryzen-9-5900x',
                'server_name' => 'Server Number One',
                'uuid' => Str::uuid(),
                'cpu_id' => 1,
                'gpu_id' => 1,
                'ram_id' => 1,
                'storage' => 512,
                'os' => 'Windows 11',
                'price_per_hour' => 20000,
                'price_per_day' => 300000,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'ryzen-7-7800x3d',
                'server_name' => 'Server Number Two',
                'uuid' => Str::uuid(),
                'cpu_id' => 1,
                'gpu_id' => 1,
                'ram_id' => 1,
                'storage' => 512,
                'os' => 'Ubuntu 22.04',
                'price_per_hour' => 15000,
                'price_per_day' => 220000,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'slug' => 'intel-i9-13900k',
                'server_name' => 'Server Number Three',
                'uuid' => Str::uuid(),
                'cpu_id' => 1,
                'gpu_id' => 1,
                'ram_id' => 1,
                'storage' => 256,
                'os' => 'Windows 10',
                'price_per_hour' => 12000,
                'price_per_day' => 180000,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
