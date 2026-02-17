<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\Server;
use App\Models\ServerCredential;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createSeeders();
        $this->actingAsUser();
    }

    public function test_user_can_see_profile(): void
    {
        $response = $this->getJson(route('profile.show'));

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'name',
                'email',
                'phone_number',
            ],
        ]);
    }

    public function test_user_can_update_profile(): void
    {
        $name = fake()->name();
        $payload = [
            'name' => $name,
        ];

        $response = $this->patchJson(route('profile.update'),
            $payload
        );

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => auth()->id(),
            'name' => $name,
        ]);
    }

    public function test_user_can_get_without_credential_reservation(): void
    {
        $server = Server::factory()->create();
        $reservation = Reservation::factory()->create([
            'user_id' => auth()->id(),
            'server_id' => $server->id,
        ]);
        ServerCredential::factory()->create([
            'reservation_id' => $reservation->id,
        ]);

        $response = $this->getJson(route('without.credential'));

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
    }

    private function actingAsUser(): User
    {
        $user = User::factory()->create();

        return tap($user, function (User $user): void {
            Passport::actingAs($user);
        });
    }

    private function createSeeders()
    {
        $this->seed('DatabaseSeeder');
    }
}
