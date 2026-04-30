<?php

namespace Tests\Feature;

use App\Models\{
    Reservation,
    Server,
    User
};

use Laravel\Passport\Passport;
use Tests\TestCase;

class ServerCredentialTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsAdmin();
    }

    public function test_admin_can_set_credential(): void
    {
        $serverId = Server::factory()->create()->getKey();
        $userId = User::factory()->user()->create()->getKey();
        $reservation = Reservation::factory()->create([
            'server_id' => $serverId,
            'user_id' => $userId,
        ]);

        $response = $this->putJson(
            route('server-credentials.put', $reservation->ulid), [
                'username' => fake()->userName(),
                'password' => 'Test@123',
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('server_credentials', [
            'reservation_id' => $reservation->id,
        ]);
    }

    private function actingAsAdmin(): void
    {
        Passport::actingAs(User::factory()->admin()
            ->create()
        );
    }
}
