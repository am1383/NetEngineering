<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;

interface ServerCredentialServiceInterface
{
    public function assignServerCredential(AssignServerCredentialDTO $dto): void;
}
