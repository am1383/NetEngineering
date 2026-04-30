<?php

namespace Tests\Feature;

use App\Models\{
    Reservation,
    Server,
    ServerCredential,
    User
};

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsUser();
    }

    public function test_user_can_see_profile(): void
    {
        $response = $this->getJson(route('show.profile'));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone_number',
                ],
            ]
        );
    }

    public function test_user_can_update_profile(): void
    {
        $name = fake()->name();

        $response = $this->patchJson(route('update.profile'), [
            'name' => $name,
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => Auth::id(),
            'name' => $name,
        ]);
    }

    public function test_user_can_get_without_credential_reservation(): void
    {
        $serverId = Server::factory()->create()->getKey();
        $reservation = Reservation::factory()->create([
            'user_id' => Auth::id(),
            'server_id' => $serverId,
        ]);
        ServerCredential::factory()->create([
            'reservation_id' => $reservation->id,
        ]);

        $response = $this->getJson(route('credential.without'));

        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }

    private function actingAsUser(): void
    {
        Passport::actingAs(User::factory()->user()
            ->create()
        );
    }
}
