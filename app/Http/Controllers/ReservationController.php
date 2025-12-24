<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Interfaces\Services\ReservationServiceInterface;

class ReservationController
{
    public function __construct(private ReservationServiceInterface $reservationService) {}

    public function store(StoreReservationRequest $request)
    {
        return $this->reservationService
            ->createReservation($request->server_id);
    }

    public function show()
    {
        return $this->reservationService
            ->getMyReservation();
    }
}
