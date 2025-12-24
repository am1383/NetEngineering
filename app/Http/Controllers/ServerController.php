<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ServerServiceInterface;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController
{
    public function __construct(private ServerServiceInterface $serverService) {}

    public function store(Request $request): Server
    {
        return $this->serverService
            ->createServer($request->validated());
    }

    public function update(Request $request, Server $server): bool
    {
        return $this->serverService
            ->updateServer($request->validated(), $server->id);
    }
}

