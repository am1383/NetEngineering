<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface ReservationRepositoryInterface extends GenericRepositoryInterface
{
    public function paidCount(): int;

    public function hasConflict(int $serverId, int $startTime, int $endTime): bool;

    public function getUserReservations(): Collection;

    public function queryFetchReservationExport(): Builder;
}
