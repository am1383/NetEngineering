<?php 
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function createUser(array $attributes): Authenticatable
    {
        return $this->userRepository->create($attributes);
    }

    public function updateUser(array $attributes): bool
    {
        return $this->userRepository
            ->updateOrFail(auth()->user(), $attributes);
    }
}
