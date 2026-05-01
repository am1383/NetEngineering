<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\ReservationCredential\AssignReservationCredentialDTO;
use App\Http\Requests\StoreReservationCredentialRequest;
use App\Interfaces\Services\ReservationCredentialServiceInterface;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;

class ReservationCredentialController extends Controller
{
    public function __construct(
        private readonly ReservationCredentialServiceInterface $reservationCredentialService
    ) {}

    public function setCredential(Reservation $reservation, StoreReservationCredentialRequest $request): JsonResponse
    {
        $this->reservationCredentialService->assignReservationCredential(
            new AssignReservationCredentialDTO(
                $reservation->id,
                $request->username,
                $request->password
            )
        );

        return $this->successResponse();
    }
}
