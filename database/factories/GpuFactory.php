<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gpu>
 */
class GpuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->name(),
            'model' => fake()->name(),
            'slug' => fake()->slug(),
            'vram' => fake()->numberBetween(2, 12),
            'chipset' => fake()->name(),
            'power' => fake()->numberBetween(5, 12),
            'price' => fake()->numberBetween(50_000, 3_000_000)
        ];
    }
}
