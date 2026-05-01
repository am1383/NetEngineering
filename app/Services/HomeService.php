<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Repositories\{
    ReservationRepositoryInterface,
    ServerRepositoryInterface,
    UserRepositoryInterface
};

use App\Interfaces\Services\HomeServiceInterface;
use Illuminate\Support\Facades\Cache;

class HomeService implements HomeServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly ReservationRepositoryInterface $reservationRepository,
        private readonly ServerRepositoryInterface $serverRepository
    ) {}

    public function getOverviewCounts(): array
    {
        return Cache::remember('overview.counts', now()->addMinutes(30), function () {
            return [
                'users' => $this->userRepository->count(),
                'servers' => $this->serverRepository->count(),
                'reservations' => $this->reservationRepository->paidStatusCount()
            ];
        });
    }
}
