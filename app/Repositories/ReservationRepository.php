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

    public function getMyReservations(): Collection
    {
        return auth()->user()->reservations()
            ->with(['server', 'credential'])
            ->get();
    }
}