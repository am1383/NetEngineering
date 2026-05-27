<?php 
declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;

use App\Interfaces\Services\{
    ReservationServiceInterface,
    ServerServiceInterface
};

use App\Models\Server;
use Illuminate\Http\JsonResponse;

class ServerController extends Controller
{
    public function __construct(
        private readonly ServerServiceInterface $serverService,
        private readonly ReservationServiceInterface $reservationService
    ) {}

    public function store(ServerRequest $request): JsonResponse
    {
        $this->serverService->createServer($request->validated());

        return $this->createdResponse();
    }

    public function update(Server $server, ServerRequest $request): JsonResponse
    {
        $this->serverService->updateServer($server, $request->validated());

        return $this->noContentResponse();
    }

    public function unavailable(Server $server): JsonResponse
    {
        return $this->successResponse($this->reservationService
            ->getServerReservationsTime($server)
        );
    }
}
