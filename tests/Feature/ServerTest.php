<?php

namespace Tests\Feature;

use App\Models\{
    Ram,
    Reservation,
    Server,
    User
};

use Laravel\Passport\Passport;
use Tests\TestCase;

class ServerTest extends TestCase
{
    public function test_admin_can_update_reserve_server(): void
    {
        $this->actingAsAdmin();
        $serverSlug = Server::factory()->create()->slug;
        $ramId = Ram::factory()->create()->getKey();

        $response = $this->patchJson(route('servers.update', $serverSlug),
            [
                'ram_id' => $ramId,
                'storage' => 512,
            ]
        );

        $response->assertOk();
        $this->assertDatabaseHas('servers', [
            'slug' => $serverSlug,
            'ram_id' => $ramId,
            'storage' => 512,
        ]);
    }

    public function test_get_server_unavailable_times(): void
    {
        $this->actingAsUser();
        $server = Server::factory()->create();
        Reservation::factory()->create([
            'server_id' => $server->id,
            'user_id' => auth()->id(),
            'start_time' => now()->addHour()->timestamp,
            'end_time' => now()->addHours(5)->timestamp,
        ]);
        Reservation::factory()->create([
            'server_id' => $server->id,
            'user_id' => auth()->id(),
            'start_time' => now()->addHours(5)->timestamp,
            'end_time' => now()->addHours(10)->timestamp,
        ]);

        $response = $this->getJson(route('servers.unavailable',
            $server->slug
        ));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'start_datetime',
                        'end_datetime',
                    ],
                ],
            ]);
    }

    public function test_get_available_servers(): void
    {
        $this->actingAsUser();
        Server::factory()->count(3)->create();
        Server::factory()->notActive()->create();

        $response = $this->getJson(route('servers.index'));

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    private function actingAsUser(): void
    {
        Passport::actingAs(User::factory()->user()
            ->create()
        );
    }

    private function actingAsAdmin(): void
    {
        Passport::actingAs(User::factory()->admin()
            ->create()
        );
    }
}
