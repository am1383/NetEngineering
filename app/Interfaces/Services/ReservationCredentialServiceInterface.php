<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTOs\ReservationCredential\AssignReservationCredentialDTO;

interface ReservationCredentialServiceInterface
{
    public function assignReservationCredential(AssignReservationCredentialDTO $dto): void;
}
