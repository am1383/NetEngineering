<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Http\Resources\ServerResource;
use App\Interfaces\Services\ReservationServiceInterface;
use App\Interfaces\Services\ServerServiceInterface;
use App\Models\Server;
use Illuminate\Http\JsonResponse;

class ServerController extends Controller
{
    public function __construct(
        private readonly ServerServiceInterface $serverService,
        private readonly ReservationServiceInterface $reservationService,
    ) {}

    public function store(ServerRequest $request): JsonResponse
    {
        $server = $this->serverService
            ->createServer($request->validated());

        return $this->successResponse(
            new ServerResource($server),
            status: 201
        );
    }

    public function update(ServerRequest $request, Server $server): JsonResponse
    {
        return $this->successResponse($this->serverService
            ->updateServer($request->validated(), $server));
    }

    public function unavailable(Server $server): JsonResponse
    {
        return $this->successResponse($this->reservationService
            ->getServerReservationsTime($server));
    }
}
