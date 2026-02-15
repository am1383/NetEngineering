<?php

namespace App\Services;

use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Interfaces\Services\ServerServiceInterface;
use App\Models\Server;
use Illuminate\Support\Collection;

class ServerService implements ServerServiceInterface
{
    public function __construct(
        private readonly ServerRepositoryInterface $serverRepository
    ) {}

    public function createServer(array $attributes): Server
    {
        return $this->serverRepository
            ->store($attributes);
    }

    public function updateServer(array $attributes, Server $server): bool
    {
        return $this->serverRepository
            ->update($attributes, $server);
    }

    public function getAvailableServers(?string $gpu, ?string $cpu): Collection
    {
        return $this->serverRepository
            ->fetchAvailableServers($gpu, $cpu);
    }
}
