<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\RoleType;

use App\Models\{
    Role,
    User
};

use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_can_register(): void
    {
        $email = fake()->unique()->email();
        Role::factory()->user()->create();

        $response = $this->postJson(route('register'), [
            'name' => fake()->userName(),
            'email' => $email,
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => 'Test@123'
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }

    
    public function test_user_cannot_set_role_id(): void
    {
        $email = fake()->email();
        Role::factory()->user()->create();
        Role::factory()->admin()->create();

        $response = $this->postJson(route('register'), [
            'name' => fake()->userName(),
            'email' => $email,
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => 'Test@123',
            'role_id' => RoleType::ADMIN->value 
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'role_id' => RoleType::USER->value
        ]);
    }

    public function test_user_registration_requires_valid_data(): void
    {
        $response = $this->postJson(route('register'), [
            'name' => '',
            'email' => 'invalid-email',
            'phone_number' => 'invalid-phone',
            'password' => 'short'
        ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'result' => [
                    'errors' => [
                        'name',
                        'email',
                        'phone_number',
                        'password'
                    ]
                ]
            ]);
    }

    public function test_user_registration_fails_with_existing_email(): void
    {
        $email = fake()->unique()->email();
        User::factory()->user()->create(['email' => $email]);

        $response = $this->postJson(route('register'), [
            'name' => fake()->userName(),
            'email' => $email,
            'password' => fake()->password(8)
        ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'result' => [
                    'errors' => [
                        'email'
                    ]
                ]
            ]);
    }
}
