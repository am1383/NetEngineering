<?php

namespace App\Interfaces\Repositories;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;

interface ServerCredentialRepositoryInterface extends GenericRepositoryInterface
{
    public function assignCredentials(AssignServerCredentialDTO $dto): void;
}
