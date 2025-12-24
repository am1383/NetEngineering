<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminReservationRequest;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Models\Reservation;

class AdminReservationController
{
    public function __construct(private ReservationRepositoryInterface $reservationRepository) {}

    public function setCredential(AdminReservationRequest $request, Reservation $reservation)
    {
        return $this->reservationRepository
            ->assignCredentials($reservation, $request->user_name, $request->password);
    }
}

