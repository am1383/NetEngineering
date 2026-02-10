<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerCredentialRequest;
use App\Interfaces\Services\ServerCredentialServiceInterface;
use App\Models\Reservation;
use Symfony\Component\HttpFoundation\JsonResponse;

class ServerCredentialController extends Controller
{
    public function __construct(
        private readonly ServerCredentialServiceInterface $serverCredentialService
    ) {}

    public function setCredential(ServerCredentialRequest $request, Reservation $reservation): JsonResponse
    {
        $this->serverCredentialService
            ->assignServerCredential($reservation->id, $request->user_name, $request->password);

        return $this->successResponse();
    }
}
