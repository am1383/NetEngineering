<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ReservationRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ReservationRepository extends GenericRepository implements ReservationRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function hasConflict(int $serverId, int $startTime, int $endTime): bool
    {
        return $this->model
            ->where('server_id', $serverId)
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime)
            ->exists();
    }

    public function fetchUserReservations(): Collection
    {
        return auth()->user()->reservations()
            ->with(['server', 'credential'])
            ->get();
    }

    public function queryFetchReservationExport(): Builder
    {
        return $this->model
            ->join('users', 'users.id', '=', 'reservations.user_id')
            ->join('servers', 'servers.id', '=', 'reservations.server_id')
            ->select([
                'users.name as user_name',
                'servers.server_name as server_name',
                'reservations.start_time',
                'reservations.end_time',
                'reservations.rent_type',
                'reservations.total_price',
                'reservations.status',
            ]);
    }

    public function paidCount(): int
    {
        return $this->model->paid()
            ->count();
    }

    public function fetchUserReserveWithoutCredential(): Collection
    {
        return $this->model->where('user_id', auth()->id())
            ->whereHas('credential', function (Builder $query): void {
                $query->whereNull('username')
                    ->whereNull('password');
            })
            ->with('server')
            ->get()
            ->pluck('server.name');
    }

    public function fetchServerReservations(int $serverId): Collection
    {
        return $this->model->select(['start_time', 'end_time'])
            ->where('server_id', $serverId)
            ->orderBy('start_time')
            ->get();
    }
}
