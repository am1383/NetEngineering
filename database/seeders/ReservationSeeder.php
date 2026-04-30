<?php

namespace Database\Seeders;

use App\Enums\{
    RentType,
    TransactionStatus
};

use App\Models\Reservation;

use Illuminate\Database\Seeder;
use Str;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
            'user_id' => 1,
            'server_id' => 1,
            'ulid' => Str::ulid(),
            'ip' => fake()->ipv4(),
            'start_time' => now()->timestamp,
            'end_time' => now()->addHours(5)->timestamp,
            'rent_type' => RentType::HOURLY_RENT->value,
            'total_price' => 50000,
            'status' => TransactionStatus::PAID->value,
        ]);
    }
}
