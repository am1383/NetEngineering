<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Interfaces\Services\LoginServiceInterface;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginService
 */
class LoginService implements LoginServiceInterface
{
    public function login(string $phoneNumber, string $password): Authenticatable
    {
        $normalizedPhoneNumber = normalizePhoneNumber($phoneNumber);

        $credentials = $this->createLoginCredentials($normalizedPhoneNumber, $password);

        throw_unless(
            Auth::attempt($credentials),
            InvalidCredentialsException::class
        );

        $user = auth()->user();

        return tap($user, function ($user) {
            $user->refresh_token = $this->createToken($user);
        });
    }

    private function createLoginCredentials(string $phoneNumber, string $password): array
    {
        return [
            'phone_number' => $phoneNumber,
            'password' => $password,
        ];
    }

    private function createToken(User $user, string $name = 'user'): string
    {
        return $user->createToken($name)->accessToken;
    }
}
