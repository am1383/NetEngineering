<?php 
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\HomeServiceInterface;

class HomeService implements HomeServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ReservationRepositoryInterface $reservationRepository,
        private readonly ServerRepositoryInterface $serverRepository,
    ) {}

    public function getOverviewCounts(): array
    {
        return [
            'users' => $this->userRepository->count(),
            'servers' => $this->serverRepository->count(),
            'reservations' => $this->reservationRepository->statusPaidCount(),
        ];
    }
}
