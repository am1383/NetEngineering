<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Http\Resources\ServerResource;
use App\Interfaces\Services\ServerServiceInterface;
use App\Models\Server;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ServerController
{
    use ApiResponseTrait;

    public function __construct(private ServerServiceInterface $serverService) {}

    public function store(ServerRequest $request): JsonResponse
    {
        $server = $this->serverService
            ->createServer($request->validated());

        return $this->successResponse(new ServerResource($server), status: 201);
    }

    public function update(ServerRequest $request, Server $server): JsonResponse
    {
        $data = $this->serverService
            ->updateServer($request->validated(), $server->id);

        return $this->successResponse($data);
    }
}

