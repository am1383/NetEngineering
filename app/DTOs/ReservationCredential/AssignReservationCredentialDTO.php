<?php 
declare(strict_types=1);

namespace App\DTOs\ReservationCredential;

final class AssignReservationCredentialDTO
{
    public function __construct(
        public readonly int $reservationId,
        public readonly string $userName,
        public readonly string $password
    ) {}
}
