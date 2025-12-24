<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserService
 */
class UserService implements UserServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function createUser(array $attributes): Authenticatable
    {
        return $this->userRepository->store($attributes);
    }

    public function updateUser(array $attributes, int $id): bool
    {
        return $this->userRepository->update($attributes, $id);
    }
}
