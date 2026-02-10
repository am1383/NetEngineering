<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Helpers\PhoneNumberHelper;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ReservationExportTest extends TestCase
{
    public function testExportReservations(): void
    {
        $this->createSeeders();
        $this->actingAsAdminUser();
        
        $response = $this->get('/api/v1/admin/export-reservations');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    private function createSeeders(): void
    {
        $this->seed('RoleSeeder');  
        $this->seed('CpuSeeder');
        $this->seed('GpuSeeder');
        $this->seed('RamSeeder');
    }

    private function actingAsAdminUser(): void
    {
        $adminUser = User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09183121519'),
            'role_id' => RoleEnum::ADMIN,
        ]);

        Passport::actingAs($adminUser);
    }
}
