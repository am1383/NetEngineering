<?php

namespace App\Services;

use App\Exceptions\ConfilictException;

use App\Interfaces\Repositories\{
    ReservationRepositoryInterface,
    ServerCredentialRepositoryInterface,
    ServerRepositoryInterface
};

use App\Interfaces\Services\ReservationServiceInterface;
use App\Models\Reservation;
use Illuminate\Support\Collection;

/**
 * Class ReservationService
 */
class ReservationService implements ReservationServiceInterface
{
    public function __construct(
        private ServerRepositoryInterface $serverRepository,
        private ReservationRepositoryInterface $reservationRepository,
        private ServerCredentialRepositoryInterface $serverCredentialRepository
    ) {}

    public function createReservation(int $serverId, int $startTime, int $endTime, string $rentType): Reservation
    {
        $server = $this->serverRepository->findOrFail($serverId);

        $hasConflict = $this->reservationRepository->hasConflict(
            $serverId,
            $startTime,
            $endTime
        );

        throw_if(
            $hasConflict,
            ConfilictException::class
        );

        $hours = $this->getDurationInHours($startTime, $endTime);

        $price = $this->calculateRentalPrice($rentType, $hours, $server->price_per_hour, $server->price_per_day);

        $reservation = $this->reservationRepository->store([
            'user_id' => auth()->id(),
            'server_id' => $server->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'rent_type' => $rentType,
            'total_price' => $price,
        ]);

        $this->serverCredentialRepository->store([
            'reservation_id' => $reservation->id
        ]);

        return $reservation;
    }

    private function getDurationInHours(int $startTime, int $endTime): float
    {
        return now()->parse($startTime)
            ->diffInHours(now()->parse($endTime));
    }

    private function calculateRentalPrice(string $rentType, int $hours, int $pricePerHour, int $pricePerDay): float
    {
        return $rentType === 'hourly'
            ? $hours * $pricePerHour
            : ceil($hours / 24) * $pricePerDay;
    }

    public function getMyReservation(): Collection
    {
        return $this->reservationRepository
            ->getMyReservations();
    }
}