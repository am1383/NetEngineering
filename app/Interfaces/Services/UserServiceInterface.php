<?php

namespace App\Interfaces\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;

interface UserServiceInterface
{
    public function createUser(array $attributes): Authenticatable;

    public function updateUser(array $attributes, int $id): bool;

    public function getUserInformationById(int $id): Authenticatable;
}
