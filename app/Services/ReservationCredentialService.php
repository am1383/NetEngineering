<?php 
declare(strict_types=1);

namespace App\Services;

use App\DTOs\ReservationCredential\AssignReservationCredentialDTO;
use App\Interfaces\Repositories\ReservationCredentialRepositoryInterface;
use App\Interfaces\Services\ReservationCredentialServiceInterface;

class ReservationCredentialService implements ReservationCredentialServiceInterface
{
    public function __construct(
        private readonly ReservationCredentialRepositoryInterface $reservationCredentialRepository
    ) {}

    public function assignReservationCredential(AssignReservationCredentialDTO $dto): void
    {
        $this->reservationCredentialRepository->assignReservationCredential($dto);
    }
}
