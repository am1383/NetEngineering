<?php

namespace App\Interfaces\Services;

interface ServerCredentialServiceInterface
{
    public function assignServerCredential(int $reservationId, string $userName, string $password): void;
}
