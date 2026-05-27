<?php

namespace Database\Factories;

use App\Enums\{
    RentType,
    TransactionStatus
};

use App\Models\{
    Server,
    User
};

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_time' => now()->addHour()->timestamp,
            'end_time' => now()->addHours(5)->timestamp,
            'user_id' => User::factory()->user(),
            'server_id' => Server::factory(),
            'status' => TransactionStatus::PAID->value,
            'rent_type' => RentType::HOURLY_RENT->value,
            'total_price' => fake()->numberBetween(50_000, 3_000_000)
        ];
    }
}
