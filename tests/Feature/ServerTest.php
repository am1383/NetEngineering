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
        $server = Server::factory()->create([
            'slug' => 'srv-teh-web-02',
            'server_name' => 'Server Number Two',
            'ram_id' => 1,
            'gpu_id' => 1,
            'storage' => 1024,
            'os' => 'Windows',
            'price_per_hour' => fake()->numberBetween(50_000, 3_000_000),
            'price_per_day' => fake()->numberBetween(50_000, 3_000_000),
            'cpu_id' => 1,
        ]);
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
            'cpu_id' => 1,
        ]);
    }

    public function test_get_available_servers(): void
    {
        $this->createSeeders();
        $this->actingAsUser();
        Server::factory()->create([
            'slug' => 'srv-teh-web-01',
            'server_name' => 'Server Number One',
            'cpu_id' => 1,
            'ram_id' => 1,
            'storage' => 256,
            'os' => 'Linux',
            'gpu_id' => 1,
            'price_per_hour' => 1400,
            'price_per_day' => 2800,
            'is_active' => true,
        ]);
        Server::factory()->create([
            'slug' => 'srv-teh-web-02',
            'server_name' => 'Server Number Two',
            'cpu_id' => 2,
            'ram_id' => 2,
            'storage' => 256,
            'os' => 'Linux',
            'price_per_hour' => 1400,
            'price_per_day' => 2800,
            'gpu_id' => 2,
            'is_active' => true,
        ]);
        Server::factory()->create([
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
