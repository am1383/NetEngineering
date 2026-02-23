<?php

namespace Database\Factories;

use App\Enums\RentTypeEnum;
use App\Enums\StatusEnum;
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
            'status' => StatusEnum::PAID->value,
            'rent_type' => RentTypeEnum::HOURLY_RENT->value,
            'total_price' => fake()->numberBetween(50_000, 3_000_000),
        ];
    }
}
