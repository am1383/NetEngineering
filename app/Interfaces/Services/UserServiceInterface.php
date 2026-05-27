<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    public function createUser(array $attributes): void;

    public function updateUser(array $attributes): void;
}
