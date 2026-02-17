<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed('RoleSeeder');
    }

    public function test_user_can_register(): void
    {
        $email = fake()->unique()->email();
        $payload = [
            'name' => fake()->userName(),
            'email' => $email,
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => 'Test@123',
        ];

        $response = $this->postJson(route('register'),
            $payload
        );

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }

    public function test_user_registration_requires_valid_data(): void
    {
        $payload = [
            'name' => '',
            'email' => 'invalid-email',
            'phone_number' => 'invalid-phone',
            'password' => 'short',
        ];

        $response = $this->postJson(route('register'), $payload);

        $response->assertUnprocessable();
    }

    public function test_user_registration_fails_with_existing_email(): void
    {
        $email = fake()->unique()->email();
        User::factory()->create(['email' => $email]);
        $payload = [
            'name' => fake()->userName(),
            'email' => $email,
            'password' => fake()->password(8),
        ];

        $response = $this->postJson(route('register'), $payload);

        $response->assertUnprocessable();
    }
}
