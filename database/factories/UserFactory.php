<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => fake()->password(8),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (): array => [
            'role_id' => Role::factory()->admin(),
        ]);
    }

    public function user(): static
    {
        return $this->state(fn (): array => [
            'role_id' => Role::factory()->user(),
        ]);
    }
}
