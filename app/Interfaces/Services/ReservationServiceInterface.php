<?php

namespace App\Interfaces\Services;

use App\DTOs\Reservation\StoreReservationDTO;
use App\Models\Reservation;
use App\Models\Server;
use Illuminate\Support\Collection;

interface ReservationServiceInterface
{
    public function storeReservation(StoreReservationDTO $dto): Reservation;

    public function getUserReserveWithoutCredential();

    public function getServerReservationsTime(Server $server): Collection;

    public function getUserReservation(): Collection;
}
