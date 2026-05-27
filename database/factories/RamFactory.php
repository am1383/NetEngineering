<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ram>
 */
class RamFactory extends Factory
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
            'capacity' => fake()->numberBetween(5, 1500),
            'frequency' => fake()->numberBetween(2, 12),
            'type' => fake()->name(),
            'slots' => fake()->numberBetween(5, 12),
            'price' => fake()->numberBetween(50_000, 3_000_000)
        ];
    }
}
