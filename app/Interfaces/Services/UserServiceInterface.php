<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;

interface UserServiceInterface
{
    public function createUser(array $attributes): Authenticatable;

    public function updateUser(array $attributes): bool;
}
