<?php

namespace App\Interfaces\Repositories;

interface ServerCredentialRepositoryInterface extends GenericRepositoryInterface
{
    public function assignCredentials(int $reservationId, string $userName, string $password): void;
}
