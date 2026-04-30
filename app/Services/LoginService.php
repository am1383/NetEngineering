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
            ->findUserByPhoneNumber($phoneNumber);

        throw_unless(
            $user and Hash::check($password, $user->password),
            InvalidCredentialsException::class
        );

        return [
            'token' => $this->createAccessToken($user)
        ];
    }

    private function createAccessToken(User $user): string
    {
        return $user->createToken('api')->accessToken;
    }
}
