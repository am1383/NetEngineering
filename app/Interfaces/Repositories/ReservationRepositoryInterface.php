<?php

namespace App\Interfaces\Repositories;

use App\Models\Reservation;
use GenericRepositoryInterface;
use Illuminate\Support\Collection;

interface ReservationRepositoryInterface extends GenericRepositoryInterface
{
    public function assignCredentials(Reservation $reservation, string $userName, string $password): void;

    public function getMyReservations(): Collection;
}