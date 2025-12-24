<?php

namespace App\Interfaces\Services;

use Illuminate\Foundation\Auth\User as Authenticatable;

interface LoginServiceInterface
{
    public function login(string $phoneNumber, string $password): Authenticatable;
}
