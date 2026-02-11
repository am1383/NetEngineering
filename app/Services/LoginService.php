<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Helpers\PhoneNumberHelper;
use App\Interfaces\Services\LoginServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService implements LoginServiceInterface
{
    public function login(string $phoneNumber, string $password): array
    {
        $credentials = $this->createLoginCredentials(
            PhoneNumberHelper::normalizePhoneNumber($phoneNumber),
            $password
        );

        $this->validateCredentials($credentials);

        return [
            'token' => $this->createToken(
                auth()->user()
            ),
        ];
    }

    private function validateCredentials(array $credentials): void
    {
        throw_unless(
            Auth::attempt($credentials),
            InvalidCredentialsException::class
        );
    }

    private function createLoginCredentials(string $phoneNumber, string $password): array
    {
        return [
            'phone_number' => $phoneNumber,
            'password' => $password,
        ];
    }

    private function createToken(User $user, string $name = 'api'): string
    {
        return $user->createToken($name)->accessToken;
    }
}
