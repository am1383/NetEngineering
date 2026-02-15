<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Helpers\PhoneNumberHelper;
use App\Models\Server;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ServerTest extends TestCase
{
    public function test_admin_user_can_update_reserve_server(): void
    {
        $this->createSeeders();
        $this->actingAsAdminUser();
        $server = Server::factory()->create();
        $payload = [
            'ram_id' => 2,
            'storage' => 512,
        ];

        $response = $this->patchJson(
            "/api/v1/admin/server/{$server->slug}",
            $payload
        );

        $response->assertOk();
        $this->assertDatabaseHas('servers', [
            'slug' => $server->slug,
            'ram_id' => 2,
            'storage' => 512,
        ]);
    }

    public function test_get_available_servers(): void
    {
        $this->createSeeders();
        $this->actingAsUser();
        Server::factory()->create([
            'storage' => 256,
            'os' => 'Linux',
            'is_active' => true,
        ]);
        Server::factory()->create([
            'storage' => 256,
            'os' => 'Linux',
            'is_active' => true,
        ]);
        Server::factory()->create([
            'storage' => 256,
            'os' => 'Linux',
            'is_active' => false,
        ]);

        $response = $this->getJson('/api/v1/servers');

        $response->assertOk()
            ->assertJsonCount(2, 'data');
    }

    private function actingAsUser(): void
    {
        $user = User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09183121516'),
            'role_id' => RoleEnum::USER->value,
        ]);

        Passport::actingAs($user);
    }

    private function actingAsAdminUser(): void
    {
        $user = User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09183121517'),
            'role_id' => RoleEnum::ADMIN->value,
        ]);

        Passport::actingAs($user);
    }

    private function createSeeders(): void
    {
        $this->seed('RoleSeeder');
        $this->seed('CpuSeeder');
        $this->seed('RamSeeder');
        $this->seed('GpuSeeder');
    }
}
