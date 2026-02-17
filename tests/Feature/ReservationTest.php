<?php

namespace Tests\Feature;

use App\Enums\RentTypeEnum;
use App\Models\Server;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createSeeders();
        $this->actingAsUser();
    }

    public function test_user_can_reserve_server(): void
    {
        $server = Server::factory()->create();
        $payload = $this->validPayload($server);

        $response = $this->postJson(route('store.reserve'), $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('reservations', [
            'server_id' => $server->id,
            'rent_type' => RentTypeEnum::DAILY_RENT,
        ]);
    }

    public function test_get_user_reservation(): void
    {
        $server = Server::factory()->create();
        $payload = $this->validPayload($server);

        $this->postJson(route('store.reserve'), $payload);
        $response = $this->getJson(route('show.reservation'));

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

    private function createSeeders(): void
    {
        $this->seed('RoleSeeder');
        $this->seed('CpuSeeder');
        $this->seed('GpuSeeder');
        $this->seed('RamSeeder');
    }

    private function actingAsUser(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);
    }
}
