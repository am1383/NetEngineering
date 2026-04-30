<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_login(): void
    {
        $this->setupPassportClient();
        $payload = [
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => 'Test@1234',
        ];

        User::factory()->user()->create($payload);

        $response = $this->postJson(route('login'), $payload);

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'token',
                ],
            ]);
    }

    public function test_login_fails_when_user_does_not_exist(): void
    {
        $response = $this->postJson(route('login'), [
            'phone_number' => fake()->regexify('09[0-9]{9}'),
            'password' => 'Test@1234',
        ]);

        $response->assertUnauthorized()
            ->assertJson([
                'message' => __('errors.invalid_credentials_error'),
            ]);
    }

    public function test_login_fails_when_phone_number_is_missing(): void
    {
        $response = $this->postJson(route('login'), [
            'password' => 'Test@1234',
        ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'status',
                'result' => [
                    'message',
                    'errors' => [
                        'phone_number',
                    ],
                ],
            ]
        );
    }

    public function test_login_fails_when_password_is_missing(): void
    {
        $response = $this->postJson(route('login'), [
            'phone_number' => fake()->regexify('09[0-9]{9}'),
        ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'status',
                'result' => [
                    'message',
                    'errors' => [
                        'password',
                    ],
                ],
            ]
        );
    }

    public function test_login_fails_when_phone_number_format_is_invalid(): void
    {
        $response = $this->postJson(route('login'), [
            'phone_number' => '123456',
            'password' => 'Test@1234',
        ]);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'status',
                'result' => [
                    'message',
                    'errors' => [
                        'phone_number',
                    ],
                ],
            ]
        );
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $phoneNumber = fake()->regexify('09[0-9]{9}');

        User::factory()->user()->create([
            'phone_number' => $phoneNumber,
            'password' => 'Correct@123',
        ]);

        $response = $this->postJson(route('login'), [
            'phone_number' => $phoneNumber,
            'password' => 'Wrong@123',
        ]);

        $response->assertUnauthorized()
            ->assertJson([
                'message' => __('errors.invalid_credentials_error'),
            ]);
    }

    public function test_login_fails_with_empty_payload(): void
    {
        $response = $this->postJson(route('login'), []);

        $response->assertUnprocessable()
            ->assertJsonStructure([
                'status',
                'result' => [
                    'message',
                    'errors' => [
                        'phone_number',
                        'password'
                    ],
                ],
            ]
        );
    }

    private function setupPassportClient(): void
    {
        Client::create([
            'id' => Str::uuid(),
            'owner_id' => null,
            'owner_type' => null,
            'name' => 'Test Personal Client',
            'secret' => Str::random(40),
            'provider' => 'users',
            'redirect_uris' => ['http://localhost'],
            'grant_types' => ['personal_access'],
            'revoked' => false,
        ]);
    }
}
