<?php

namespace Database\Factories;

use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Ram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Server>
 */
class ServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(12),
            'server_name' => fake()->name(),
            'ram_id' => Ram::firstOrFail(),
            'gpu_id' => Gpu::firstOrFail(),
            'storage' => 1024,
            'os' => 'Windows',
            'price_per_hour' => fake()->numberBetween(50_000, 3_000_000),
            'price_per_day' => fake()->numberBetween(50_000, 3_000_000),
            'cpu_id' => Cpu::firstOrFail(),
        ];
    }
}
