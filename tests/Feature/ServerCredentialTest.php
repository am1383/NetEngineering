<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Helpers\PhoneNumberHelper;
use App\Models\Reservation;
use App\Models\Server;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ServerCredentialTest extends TestCase
{
    public function test_admin_can_set_credential(): void
    {
        $this->createSeeders();
        $serverId = $this->createServer();
        $this->actingAsAdminUser();
        $userId = $this->createUser();
        $reservation = $this->createReservation($userId, $serverId);
        $payload = [
            'user_name' => 'Username test',
            'password' => 'test123',
        ];

        $response = $this->putJson(
            "/api/v1/admin/reservation/{$reservation->uuid}/credential",
            $payload
        );

        $response->assertOk();
        $this->assertDatabaseHas('server_credentials', [
            'reservation_id' => $reservation->id,
        ]);
    }

    private function createReservation(int $userId, int $serverId): Reservation
    {
        return Reservation::factory()->create([
            'server_id' => $serverId,
            'start_time' => now()->addHour()->timestamp,
            'end_time' => now()->addHours(5)->timestamp,
            'total_price' => fake()->numberBetween(50_000, 3_000_000),
            'status' => StatusEnum::PAID,
            'user_id' => $userId,
        ]);
    }

    private function createServer(): int
    {
        return Server::factory()->create([
            'slug' => 'srv-teh-web-03',
            'server_name' => 'Server Number Three',
            'cpu_id' => 1,
            'ram_id' => 1,
            'storage' => 256,
            'price_per_hour' => fake()->numberBetween(50_000, 3_000_000),
            'price_per_day' => fake()->numberBetween(50_000, 3_000_000),
            'os' => 'Linux',
            'gpu_id' => 1,
            'is_active' => false,
        ])->id;
    }

    private function actingAsAdminUser(): void
    {
        $adminUser = User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09183121519'),
            'role_id' => RoleEnum::ADMIN->value,
        ]);

        Passport::actingAs($adminUser);
    }

    private function createUser(): int
    {
        return User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09183121516'),
            'role_id' => RoleEnum::USER->value,
        ])->id;
    }

    private function createSeeders(): void
    {
        $this->seed('RoleSeeder');
        $this->seed('CpuSeeder');
        $this->seed('RamSeeder');
        $this->seed('GpuSeeder');
    }
}
