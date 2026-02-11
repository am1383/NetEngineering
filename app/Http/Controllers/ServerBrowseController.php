<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerBrowseRequest;
use App\Http\Resources\ServerResource;
use App\Interfaces\Services\ServerServiceInterface;
use Illuminate\Http\JsonResponse;

class ServerBrowseController extends Controller
{
    public function __construct(
        private readonly ServerServiceInterface $serverService
    ) {}

    public function index(ServerBrowseRequest $request): JsonResponse
    {
        $servers = $this->serverService
            ->getAvailableServers(
                $request->query('gpu'),
                $request->query('cpu')
            );

        return $this->successResponse(
            ServerResource::collection($servers)
        );
    }
}
