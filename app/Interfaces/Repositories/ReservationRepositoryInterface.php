<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\{
    Server,
    User
};

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface ReservationRepositoryInterface extends GenericRepositoryInterface
{
    public function paidStatusCount(): int;

    public function hasConflict(Server $server, int $startTime, int $endTime): bool;

    public function fetchUserReservations(User $user): Collection;

    public function fetchUserReservationsWithoutCredential(User $user): Collection;

    public function fetchServerReservations(Server $server): Collection;

    public function reservationExportQuery(): Builder;
}
