<?php

namespace App\Http\Controllers;

use App\DTOs\Reservation\StoreReservationDTO;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Interfaces\Services\ReservationServiceInterface;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function __construct(
        private readonly ReservationServiceInterface $reservationService
    ) {}

    public function store(StoreReservationRequest $request): JsonResponse
    {
        $reservation = $this->reservationService
            ->storeReservation(new StoreReservationDTO(
                $request->server_uuid,
                $request->start_time,
                $request->end_time,
                $request->rent_type
            ));

        return $this->successResponse(
            new ReservationResource($reservation),
            status: 201
        );
    }

    public function show(): JsonResponse
    {
        return $this->successResponse( ReservationResource::collection(
            $this->reservationService
                ->getUserReservation()
        ));
    }
}
