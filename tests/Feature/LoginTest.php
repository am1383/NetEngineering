<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('RoleSeeder');
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $phoneNumber = fake()->regexify('09[0-9]{9}');
        User::factory()->create([
            'phone_number' => $phoneNumber,
        ]);

        $response = $this->postJson(route('login'), [
            'phone_number' => $phoneNumber,
            'password' => 'Wrong-password@123',
        ]);

        $response->assertUnauthorized()
            ->assertJson([
                'message' => __('errors.invalid_credentials_error'),
            ]);
    }
}
