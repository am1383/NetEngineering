<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;

interface ServerCredentialRepositoryInterface extends GenericRepositoryInterface
{
    public function assignCredentials(AssignServerCredentialDTO $dto): void;
}
