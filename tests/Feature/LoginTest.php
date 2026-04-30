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

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $phoneNumber = fake()->regexify('09[0-9]{9}');
        User::factory()->user()->create([
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
