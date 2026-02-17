<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\Reservation;
use App\Models\Server;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ServerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    public function test_admin_user_can_update_reserve_server(): void
    {
        $this->actingAsAdminUser();
        $server = Server::factory()->create();
        $payload = [
            'ram_id' => 2,
            'storage' => 512,
        ];

        $response = $this->patchJson(
            route('update.server', $server->slug),
            $payload
        );

        $response->assertOk();
        $this->assertDatabaseHas('servers', [
            'slug' => $server->slug,
            'ram_id' => 2,
            'storage' => 512,
        ]);
    }

    public function test_get_server_unavailable_times(): void
    {
        $this->actingAsUser();
        $server = Server::factory()->create();
        $serverId = $server->id;
        Reservation::factory()->create([
            'server_id' => $serverId,
            'user_id' => auth()->id(),
            'start_time' => now()->addHour()->timestamp,
            'end_time' => now()->addHours(5)->timestamp,
        ]);
        Reservation::factory()->create([
            'server_id' => $serverId,
            'user_id' => auth()->id(),
            'start_time' => now()->addHour(5)->timestamp,
            'end_time' => now()->addHours(10)->timestamp,
        ]);

        $response = $this->getJson(
            route('unavailabe.server',
                $server->slug
            ));

        $response->assertOk();
    }

    public function test_get_available_servers(): void
    {
        $this->actingAsUser();

        $response = $this->getJson(route('index.server'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    private function actingAsUser(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);
    }

    private function actingAsAdminUser(): void
    {
        $adminUser = User::factory()->create([
            'role_id' => RoleEnum::ADMIN->value,
        ]);

        Passport::actingAs($adminUser);
    }
}
