<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminReservationRequest;
use App\Interfaces\Repositories\ReservationRepositoryInterface;
use App\Models\Reservation;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminReservationController
{
    use ApiResponseTrait;

    public function __construct(private ReservationRepositoryInterface $reservationRepository) {}

    public function setCredential(AdminReservationRequest $request, Reservation $reservation): JsonResponse
    {
        $this->reservationRepository
            ->assignCredentials($reservation, $request->user_name, $request->password);
        
        return $this->successResponse();
    }
}
