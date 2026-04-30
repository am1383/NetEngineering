<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

interface LoginServiceInterface
{
    public function login(string $phoneNumber, string $password): array;
}
