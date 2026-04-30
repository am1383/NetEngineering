<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTOs\Reservation\StoreReservationDTO;

use App\Models\{
    Reservation,
    Server
};

use Illuminate\Support\Collection;

interface ReservationServiceInterface
{
    public function storeReservation(StoreReservationDTO $dto): Reservation;

    public function getUserReserveWithoutCredential(): Collection;

    public function getServerReservationsTime(Server $server): Collection;

    public function getUserReservation(): Collection;
}
