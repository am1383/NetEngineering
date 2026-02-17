<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ReservationExportTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
        $this->actingAsAdminUser();
    }

    public function test_export_reservations(): void
    {
        $response = $this->get(route('export.reservation'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    private function actingAsAdminUser(): void
    {
        $adminUser = User::factory()->create([
            'role_id' => RoleEnum::ADMIN->value,
        ]);

        Passport::actingAs($adminUser);
    }
}
