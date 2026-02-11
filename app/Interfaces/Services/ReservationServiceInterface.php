<?php

namespace App\Interfaces\Services;

use App\DTOs\Reservation\StoreReservationDTO;
use App\Models\Reservation;
use Illuminate\Support\Collection;

interface ReservationServiceInterface
{
    public function storeReservation(StoreReservationDTO $dto): Reservation;

    public function getUserReservation(): Collection;
}
