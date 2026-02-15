<?php

namespace Tests\Feature;

use App\Enums\RentTypeEnum;
use App\Enums\RoleEnum;
use App\Helpers\PhoneNumberHelper;
use App\Models\Server;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    public function test_user_can_reserve_server(): void
    {
        $this->createSeeders();
        $this->actingAsUser();
        $server = $this->createServer();
        $payload = $this->validPayload($server);

        $response = $this->postJson('/api/v1/reserve', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('reservations', [
            'server_id' => $server->id,
            'rent_type' => RentTypeEnum::DAILY_RENT,
        ]);
    }

    public function test_get_user_reservation(): void
    {
        $this->createSeeders();
        $this->actingAsUser();
        $server = $this->createServer();
        $payload = $this->validPayload($server);

        $this->postJson('/api/v1/reserve', $payload);
        $response = $this->getJson('/api/v1/my-reservations');

        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }

    private function validPayload(Server $server): array
    {
        return [
            'server_uuid' => $server->uuid,
            'start_time' => now()->addHour()->toDateTimeString(),
            'end_time' => now()->addHours(5)->toDateTimeString(),
            'rent_type' => RentTypeEnum::DAILY_RENT,
        ];
    }

    private function createServer(): Server
    {
        return Server::factory()->create([
            'storage' => 512,
            'os' => 'Linux',
        ]);
    }

    private function createSeeders(): void
    {
        $this->seed('RoleSeeder');
        $this->seed('CpuSeeder');
        $this->seed('GpuSeeder');
        $this->seed('RamSeeder');
    }

    private function actingAsUser(): int
    {
        $user = User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09183121516'),
            'role_id' => RoleEnum::USER->value,
        ]);

        Passport::actingAs($user);

        return $user->id;
    }
}
