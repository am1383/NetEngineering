<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusTest extends TestCase
{
    public function test_get_status(): void
    {
        $this->createSeeders();

        $response = $this->getJson('/api/v1/status');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'users',
                    'servers',
                    'reservations',
                ],
            ])
            ->assertJsonPath('data.users', 3)
            ->assertJsonPath('data.servers', 3)
            ->assertJsonPath('data.reservations', 1);
    }

    private function createSeeders(): void
    {
        $this->seed('DatabaseSeeder');
    }
}
