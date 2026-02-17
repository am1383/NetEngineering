<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\Reservation;
use App\Models\Server;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ServerCredentialTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createSeeders();
        $this->actingAsAdminUser();
    }

    public function test_admin_can_set_credential(): void
    {
        $serverId = Server::factory()->create()->id;
        $userId = User::factory()->create()->id;
        $reservation = $this->createReservation($userId, $serverId);
        $payload = [
            'user_name' => fake()->userName(),
            'password' => 'Test@123',
        ];

        $response = $this->putJson(
            route('put.server.credential', $reservation->uuid),
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
            'user_id' => $userId,
        ]);
    }

    private function actingAsAdminUser(): void
    {
        $adminUser = User::factory()->create([
            'role_id' => RoleEnum::ADMIN->value,
        ]);

        Passport::actingAs($adminUser);
    }

    private function createSeeders(): void
    {
        $this->seed('RoleSeeder');
        $this->seed('CpuSeeder');
        $this->seed('RamSeeder');
        $this->seed('GpuSeeder');
    }
}
