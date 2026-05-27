<?php

namespace Database\Factories;

use App\Enums\RoleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (): array => [
            'id' => RoleType::ADMIN->value,
            'name' => 'admin'
        ]);
    }

    public function user(): static
    {
        return $this->state(fn (): array => [
            'id' => RoleType::USER->value,
            'name' => 'user'
        ]);
    }
}
