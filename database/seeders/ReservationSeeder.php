<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Server;
use App\Models\ServerCredential;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        $server = Server::first();

        if (!$user or !$server) {
            return;
        }

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'server_id' => $server->id,
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(5),
            'rent_type' => 'hourly',
            'total_price' => 100000,
            'status' => 'paid',
        ]);

        ServerCredential::create([
            'reservation_id' => $reservation->id,
            'username' => null,
            'password' => null,
        ]);
    }
}
