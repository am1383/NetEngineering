<?php 
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\LoginServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function login(string $phoneNumber, string $password): array
    {
        $user = $this->userRepository
            ->findUserByPhoneNumber($phoneNumber, ['id', 'password']);

        throw_unless(
            $this->isValidUser($user, $password),
            InvalidCredentialsException::class
        );

        return [
            'token' => $this->createAccessToken($user)
        ];
    }

    private function isValidUser(?User $user, string $password): bool
    {
        return $user and Hash::check($password, $user->password);
    }

    private function createAccessToken(User $user, string $name = 'api'): string
    {
        return $user->createToken($name)->accessToken;
    }
}
