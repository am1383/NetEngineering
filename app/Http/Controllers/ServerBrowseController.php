<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerBrowseRequest;
use App\Http\Resources\ServerResource;
use App\Interfaces\Services\ServerServiceInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ServerBrowseController
{
    use ApiResponseTrait;

    public function __construct(private ServerServiceInterface $serverService) {}

    public function index(ServerBrowseRequest $request): JsonResponse
    {
        $servers = $this->serverService
            ->getAvailableServers($request->gpu, $request->cpu);

        return $this->successResponse(ServerResource::collection($servers));
    }
}
