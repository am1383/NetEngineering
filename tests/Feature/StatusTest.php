<?php

namespace Tests\Feature;

use App\Models\{
    Reservation,
    Server,
    User
};

use Tests\TestCase;

class StatusTest extends TestCase
{
    public function test_get_status(): void
    {
        $userId = User::factory()->user()->create()->getKey();
        $serverId = Server::factory()->create()->getKey();
        Reservation::factory()->create([
            'user_id' => $userId,
            'server_id' => $serverId,
        ]);

        $response = $this->getJson(route('home.status'));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'users',
                    'servers',
                    'reservations',
                ],
            ])
            ->assertJsonPath('data.users', 1)
            ->assertJsonPath('data.servers', 1)
            ->assertJsonPath('data.reservations', 1);
    }
}
