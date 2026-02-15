<?php

namespace App\Services;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;
use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use App\Interfaces\Services\ServerCredentialServiceInterface;

class ServerCredentialService implements ServerCredentialServiceInterface
{
    public function __construct(
        private readonly ServerCredentialRepositoryInterface $serverCredentialRepository,
    ) {}

    public function assignServerCredential(AssignServerCredentialDTO $dto): void
    {
        $this->serverCredentialRepository
            ->assignCredentials($dto);
    }
}
