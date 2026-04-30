<?php 
declare(strict_types=1); 

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Http\Resources\ServerResource;

use App\Interfaces\Services\{
    ReservationServiceInterface,
    ServerServiceInterface
};

use App\Models\Server;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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

        return $this->successResponse(new ServerResource($server),
            Response::HTTP_CREATED
        );
    }

    public function update(Server $server, ServerRequest $request): JsonResponse
    {
        return $this->successResponse($this->serverService
            ->updateServer($server, $request->validated())
        );
    }

    public function unavailable(Server $server): JsonResponse
    {
        return $this->successResponse($this->reservationService
            ->getServerReservationsTime($server)
        );
    }
}
