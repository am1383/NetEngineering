<?php

namespace App\Interfaces\Services;

interface LoginServiceInterface
{
    public function login(string $phoneNumber, string $password): array;
}
