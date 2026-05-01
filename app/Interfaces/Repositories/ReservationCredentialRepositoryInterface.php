<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\DTOs\ReservationCredential\AssignReservationCredentialDTO;

interface ReservationCredentialRepositoryInterface extends GenericRepositoryInterface
{
    public function assignReservationCredential(AssignReservationCredentialDTO $dto): void;
}
