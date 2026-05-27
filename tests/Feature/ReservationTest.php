<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\RentType;

use App\Models\{
    Reservation,
    Server
};

use Tests\TestCase;

class ReservationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->actingAsUser();
    }

    public function test_user_can_reserve_server(): void
    {
        $server = Server::factory()->create();

        $response = $this->postJson(route('reserves.store'), [
            'server_ulid' => $server->ulid,
            'start_time' => now()->addHour()->toDateTimeString(),
            'end_time' => now()->addHours(5)->toDateTimeString(),
            'rent_type' => RentType::DAILY_RENT->value
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('reservations', [
            'server_id' => $server->id,
            'rent_type' => RentType::DAILY_RENT->value
        ]);
    }

    public function test_get_user_reservation(): void
    {
        $serverId = Server::factory()->create()->getKey();
        Reservation::factory()->create([
            'user_id' => auth()->id(),
            'server_id' => $serverId
        ]);
 
        $response = $this->getJson(route('reservations.index'));

        $response->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
