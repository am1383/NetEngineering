<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cpu>
 */
class CpuFactory extends Factory
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
            'cores' => fake()->numberBetween(4, 8),
            'threads' => fake()->numberBetween(2, 16),
            'base_clock' => fake()->numberBetween(2500, 3500),
            'boost_clock' => fake()->numberBetween(30, 500),
            'socket' => fake()->name(),
            'tdp' => fake()->numberBetween(24, 65),
            'price' => fake()->numberBetween(50_000, 3_000_000)
        ];
    }
}
