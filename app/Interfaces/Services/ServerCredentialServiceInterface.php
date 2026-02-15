<?php

namespace App\Interfaces\Services;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;

interface ServerCredentialServiceInterface
{
    public function assignServerCredential(AssignServerCredentialDTO $dto): void;
}
