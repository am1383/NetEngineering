<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_can_register(): void
    {
        $this->createRoleSeeder();
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '09183121518',
            'password' => 'Test@1234',
        ];

        $response = $this->postJson('/api/v1/register', $payload);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
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

        $response = $this->postJson('/api/v1/register', $payload);

        $response->assertStatus(422);
    }

    public function test_user_registration_fails_with_existing_email(): void
    {
        $this->createRoleSeeder();
        $this->createUser();

        $payload = [
            'name' => 'Jane Doe',
            'email' => 'john@example.com',
            'phone_number' => '09183121519',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/v1/register', $payload);

        $response->assertStatus(422);
    }

    private function createUser(): void
    {
        User::factory()->create([
            'email' => 'john@example.com',
            'role_id' => RoleEnum::USER->value,
            'phone_number' => '09183121518',
            'password' => 'password',
        ]);
    }

    private function createRoleSeeder(): void
    {
        $this->seed('RoleSeeder');
    }
}
