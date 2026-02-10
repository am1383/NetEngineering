<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Helpers\PhoneNumberHelper;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_cannot_login_with_wrong_password(): void
    {
        $this->createUser();

        $response = $this->postJson('/api/v1/login', [
            'phone_number' => '09123334444',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'message' => __('errors.invalid_credentials_error'),
            ]);
    }

    private function createUser(): void
    {
        $this->seed('RoleSeeder');

        User::factory()->create([
            'phone_number' => PhoneNumberHelper::normalizePhoneNumber('09123334444'),
            'role_id' => RoleEnum::USER,
            'password' => 'secret123',
        ]);
    }
}
