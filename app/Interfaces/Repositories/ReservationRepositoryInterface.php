<?php

namespace App\Interfaces\Repositories;

use App\Models\Reservation;
use Illuminate\Support\Collection;

interface ReservationRepositoryInterface extends GenericRepositoryInterface
{
    public function assignCredentials(Reservation $reservation, string $userName, string $password): void;

    public function hasConflict(int $serverId, int $startTime, int $endTime): bool;

    public function getMyReservations(): Collection;
}