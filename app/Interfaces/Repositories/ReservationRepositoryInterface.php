<?php

namespace App\Interfaces\Repositories;

use App\Models\Reservation;
use GenericRepositoryInterface;

interface ReservationRepositoryInterface extends GenericRepositoryInterface
{
    public function assignCredentials(Reservation $reservation, string $userName, string $password): void;
}