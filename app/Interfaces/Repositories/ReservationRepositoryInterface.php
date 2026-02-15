<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface ReservationRepositoryInterface extends GenericRepositoryInterface
{
    public function paidCount(): int;

    public function hasConflict(int $serverId, int $startTime, int $endTime): bool;

    public function fetchUserReservations(): Collection;

    public function fetchUserReserveWithoutCredential(): Collection;

    public function fetchServerReservations(int $serverId): Collection;

    public function queryFetchReservationExport(): Builder;
}
