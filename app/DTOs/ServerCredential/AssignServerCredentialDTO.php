<?php 
declare(strict_types=1);

namespace App\DTOs\ServerCredential;

final class AssignServerCredentialDTO
{
    public function __construct(
        public readonly int $reservationId,
        public readonly string $userName,
        public readonly string $password,
    ) {}
}
