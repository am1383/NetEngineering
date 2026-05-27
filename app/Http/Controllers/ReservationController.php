<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\Reservation\CreateReservationDTO;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Interfaces\Services\ReservationServiceInterface;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    public function __construct(
        private readonly ReservationServiceInterface $reservationService
    ) {}

    public function index(): JsonResponse
    {
        return $this->successResponse(ReservationResource::collection(
            $this->reservationService->getUserReservations()
        ));
    }

    public function store(CreateReservationRequest $request): JsonResponse
    {
        $this->reservationService->createReservation(
            new CreateReservationDTO(
                $request->server_ulid,
                $request->start_time,
                $request->end_time,
                $request->rent_type
            ));

        return $this->createdResponse();
    }

    public function withoutCredential(): JsonResponse
    {
        return $this->successResponse($this->reservationService
            ->getUserReservationsWithoutCredential()
        );
    }
}
