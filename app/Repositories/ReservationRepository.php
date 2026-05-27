<?php 
declare(strict_types=1); 

namespace App\Repositories;

use App\Interfaces\Repositories\ReservationRepositoryInterface;

use App\Models\{
    Server,
    User
};

use Illuminate\Database\Eloquent\{
    Builder,
    Model
};

use Illuminate\Support\Collection;

class ReservationRepository extends GenericRepository implements ReservationRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function hasConflict(Server $server, int $startTime, int $endTime): bool
    {
        return $this->model->whereBelongsTo($server)
            ->where('start_time', '<', $endTime)
            ->where('end_time', '>', $startTime)
            ->exists();
    }

    public function fetchUserReservations(User $user): Collection
    {
        return $user->reservations()
            ->with(['server', 'credential'])
            ->get();
    }

    public function reservationExportQuery(): Builder
    {
        return $this->model->join('users', 'users.id', 'reservations.user_id')
            ->join('servers', 'servers.id', 'reservations.server_id')
            ->select([
                'users.name as username',
                'servers.name as name',
                'reservations.start_time',
                'reservations.end_time',
                'reservations.rent_type',
                'reservations.total_price',
                'reservations.status'
            ]);
    }

    public function paidStatusCount(): int
    {
        return $this->model->paidStatus()
            ->count();
    }

    public function fetchUserReservationsWithoutCredential(User $user): Collection
    {
        return $user->reservations()
            ->whereRelation('credential', function (Builder $query): void {
                $query->whereNull('username')->whereNull('password');
            })
            ->join('servers', 'reservations.server_id', '=', 'servers.id')
            ->pluck('servers.name');
    }

    public function fetchServerReservations(Server $server): Collection
    {
        return $server->reservations()->select(['start_time', 'end_time'])
            ->latest('start_time')
            ->get();
    }
}
