<?php 
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function createUser(array $attributes): void
    {
        $this->userRepository->create($attributes);
    }

    public function updateUser(array $attributes): void
    {
        $this->userRepository
            ->updateOrFail(auth()->user(), $attributes);
    }
}
