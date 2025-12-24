<?php

namespace App\Interfaces\Services;

interface ReservationServiceInterface
{
    public function createReservation(int $serverId);
}