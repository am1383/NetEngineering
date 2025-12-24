<?php

namespace App\Interfaces\Services;

use Illuminate\Support\Collection;

interface ReservationServiceInterface
{
    public function createReservation(int $serverId);

    public function getMyReservation(): Collection;
}