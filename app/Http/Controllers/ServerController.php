<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Interfaces\Services\ServerServiceInterface;
use App\Models\Server;

class ServerController
{
    public function __construct(private ServerServiceInterface $serverService) {}

    public function store(ServerRequest $request): Server
    {
        return $this->serverService
            ->createServer($request->validated());
    }

    public function update(ServerRequest $request, Server $server): bool
    {
        return $this->serverService
            ->updateServer($request->validated(), $server->id);
    }
}

