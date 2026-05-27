<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\RoleType;

use App\Models\{
    Reservation,
    Server,
    ReservationCredential
};

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
        $response = $this->getJson(route('profile.show'));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone_number'
                ],
            ]
        );
    }

    public function test_user_can_update_profile(): void
    {
        $name = fake()->name();

        $response = $this->patchJson(route('profile.update'), [
            'name' => $name
        ]);

        $response->assertNoContent();
        $this->assertDatabaseHas('users', [
            'id' => auth()->id(),
            'name' => $name
        ]);
    }

    public function test_user_cannot_create_admin(): void
    {
        $email = fake()->safeEmail();

        $response = $this->postJson(route('users.store'), [
            'email' => $email,
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => 'Test@1234',
            'role_id' => RoleType::ADMIN->value,
            'name' => fake()->name()
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'role_id' => RoleType::USER->value
        ]);
    }

    public function test_user_can_get_without_credential_reservation(): void
    {
        $serverId = Server::factory()->create()->getKey();
        $reservation = Reservation::factory()->create([
            'user_id' => auth()->id(),
            'server_id' => $serverId
        ]);
        ReservationCredential::factory()->create([
            'reservation_id' => $reservation->id
        ]);

        $response = $this->getJson(route('credential.without'));

        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
