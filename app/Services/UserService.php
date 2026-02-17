<?php

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
        return $this->userRepository
            ->store($attributes);
    }

    public function updateUser(array $attributes): bool
    {
        return $this->userRepository
            ->update($attributes, auth()->user());
    }

    public function getUserInformation(): Authenticatable
    {
        return $this->userRepository
            ->findOrFail(auth()->id());
    }
}
