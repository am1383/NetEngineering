<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;
use App\Http\Requests\StoreServerCredentialRequest;
use App\Interfaces\Services\ServerCredentialServiceInterface;
use App\Models\Reservation;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServerCredentialController extends Controller
{
    public function __construct(
        private readonly ServerCredentialServiceInterface $serverCredentialService
    ) {}

    public function setCredential(Reservation $reservation, StoreServerCredentialRequest $request): JsonResponse
    {
        $this->serverCredentialService->assignServerCredential(
            new AssignServerCredentialDTO(
                $reservation->id,
                $request->username,
                $request->password,
            )
        );

        return $this->successResponse();
    }
}
