<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    public function test_get_status(): void
    {
        $response = $this->getJson(route('home.status'));

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
}
