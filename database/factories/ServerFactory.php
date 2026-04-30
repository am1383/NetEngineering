<?php

namespace Database\Factories;

use App\Models\{
    Cpu,
    Gpu,
    Ram
};

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
            'name' => fake()->name(),
            'is_active' => true,
            'ram_id' => Ram::factory()->create()->getKey(),
            'gpu_id' => Gpu::factory()->create()->getKey(),
            'storage' => fake()->numberBetween(1024, 2048),
            'os' => fake()->randomElement(['Windows', 'Linux']),
            'price_per_hour' => fake()->numberBetween(50_000, 3_000_000),
            'price_per_day' => fake()->numberBetween(50_000, 3_000_000),
            'cpu_id' => Cpu::factory()->create()->getKey(),
        ];
    }

    public function notActive(): static
    {
        return $this->state(fn (): array => [
            'is_active' => false,
        ]);
    }
}
