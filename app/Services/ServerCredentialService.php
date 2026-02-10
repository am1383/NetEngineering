<?php

namespace App\Services;

use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use App\Interfaces\Services\ServerCredentialServiceInterface;

class ServerCredentialService implements ServerCredentialServiceInterface
{
    public function __construct(
        private readonly ServerCredentialRepositoryInterface $serverCredentialRepository
    ) {}

    public function assignServerCredential(int $reservationId, string $userName, string $password): void
    {
        $this->serverCredentialRepository
            ->assignCredentials($reservationId, $userName, $password);
    }
}
