<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ReservationController
{
    use ApiResponseTrait;

    public function __construct(private ReservationServiceInterface $reservationService) {}

    public function store(StoreReservationRequest $request): JsonResponse
    {
        $reservation = $this->reservationService
            ->createReservation($request->server_id);

        return $this->successResponse(new ReservationResource($reservation), status: 201);
    }

    public function show(): JsonResponse
    {
        return $this->successResponse(new ReservationResource($this->reservationService
            ->getMyReservation()));
    }
}
