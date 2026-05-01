<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ReservationExportTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAsAdmin();
    }

    public function test_export_reservations(): void
    {
        $response = $this->get(route('reservations.export'));

        $response->assertOk()
            ->assertHeader('Content-Type',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            );
    }
}
