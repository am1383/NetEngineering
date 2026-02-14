<?php

namespace Database\Seeders;

use App\Enums\RentTypeEnum;
use App\Enums\StatusEnum;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleId = Role::where('name', 'user')
            ->value('id');
        $user = User::where('role_id', $roleId)
            ->firstOrFail();
        $server = Server::firstOrFail();

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'uuid' => Str::uuid(),
            'ip' => fake()->ipv4(),
            'server_id' => $server->id,
            'start_time' => now()->timestamp,
            'end_time' => now()->addHours(5)->timestamp,
            'rent_type' => RentTypeEnum::HOURLY_RENT,
            'total_price' => fake()->numberBetween(50_000, 3_000_000),
            'status' => StatusEnum::PAID,
        ]);
    }
}
