<?php

namespace App\Interfaces\Services;

use App\Models\Reservation;
use Illuminate\Support\Collection;

interface ReservationServiceInterface
{
    public function createReservation(int $serverId, int $startTime, int $endTime, string $rentType): Reservation;

    public function getMyReservation(): Collection;
}