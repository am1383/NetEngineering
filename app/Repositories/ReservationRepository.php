<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ReservationRepository extends GenericRepository implements ReservationRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function assignCredentials(Reservation $reservation, string $userName, string $password): void
    {
        $reservation->credential()->update([
            'username' => $userName,
            'password' => $password,
        ]);
    }

    public function hasConflict(int $serverId, int $startTime, int $endTime): bool
    {
        return $this->model->where('server_id', $serverId)
            ->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                  ->orWhereBetween('end_time', [$startTime, $endTime]);
            })->exists();
    }

    public function getMyReservations(): Collection
    {
        return auth()->user()->reservations()
            ->with(['server', 'credential'])
            ->get();
    }
}