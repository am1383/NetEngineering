<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Reservation;
use Tests\TestCase;

class ReservationCredentialTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsAdmin();
    }

    public function test_admin_can_set_credential(): void
    {
        $reservation = $this->createReservation();

        $response = $this->putJson(
            route('reservation-credentials.put', $reservation->ulid),
            [
                'username' => fake()->userName(),
                'password' => 'Test@123',
            ]
        );

        $response->assertOk();
        $this->assertDatabaseHas('reservation_credentials', [
            'reservation_id' => $reservation->id,
        ]);
    }

    public function test_set_credential_fails_when_reservation_not_found(): void
    {
        $response = $this->putJson(
            route('reservation-credentials.put', '01INVALIDULID000000000000'),
            [
                'username' => fake()->userName(),
                'password' => 'Test@123',
            ]
        );

        $response->assertNotFound()
            ->assertJson([
                'message' => __('errors.not_found')
           ]
        );
    }

    public function test_username_is_required(): void
    {
        $reservation = $this->createReservation();

        $response = $this->putJson(
            route('reservation-credentials.put', $reservation->ulid),
            [
                'password' => 'Test@123',
            ]
        );

        $response->assertUnprocessable()
             ->assertJsonStructure([
                'status',
                'result' => [
                    'message',
                    'errors' => [
                        'username',
                    ],
                ],
            ]
        );
    }

    public function test_password_validation_fails(): void
    {
        $reservation = $this->createReservation();

        $response = $this->putJson(
            route('reservation-credentials.put', $reservation->ulid),
            [
                'username' => fake()->userName(),
                'password' => '123',
            ]
        );

        $response->assertUnprocessable()
             ->assertJsonStructure([
                'status',
                'result' => [
                    'message',
                    'errors' => [
                        'password',
                    ],
                ],
            ]);
    }

    public function test_race_condition_creates_only_one_credential(): void
    {
        $reservation = $this->createReservation();
        $payload = [
            'username' => 'race_user',
            'password' => 'Test@123',
        ];

        $this->putJson(route('reservation-credentials.put', $reservation->ulid), $payload);
        $this->putJson(route('reservation-credentials.put', $reservation->ulid), $payload);

        $this->assertDatabaseCount('reservation_credentials', 1);
    }

    public function test_no_partial_data_is_saved_on_failure(): void
    {
        $reservation = $this->createReservation();

        $this->putJson(
            route('reservation-credentials.put', $reservation->ulid),
            [
                'username' => null,
                'password' => null,
            ]
        );

        $this->assertDatabaseMissing('reservation_credentials', [
            'reservation_id' => $reservation->id,
        ]);
    }

    private function createReservation(): Reservation
    {
        return Reservation::factory()->create();
    }
}
