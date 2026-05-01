<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\{
    Reservation,
    Server,
    User
};

use Tests\TestCase;

class HomeStatusTest extends TestCase
{
    public function test_get_status_overview_counts(): void
    {
        Reservation::factory()->create([
            'user_id' => User::factory()->user()->create()->getKey(),
            'server_id' => Server::factory()->create()->getKey()
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
