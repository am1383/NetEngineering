<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerBrowseRequest;
use App\Interfaces\Services\ServerServiceInterface;

class ServerBrowseController
{
    public function __construct(private ServerServiceInterface $serverService) {}

    public function index(ServerBrowseRequest $request)
    {
        return $this->serverService
            ->getAvailableServers($request->gpu, $request->cpu);
    }
}
