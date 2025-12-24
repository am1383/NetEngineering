<?php

namespace App\Services;

use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Interfaces\Services\ServerServiceInterface;
use App\Models\Server;
use Illuminate\Support\Collection;

/**
 * Class ServerService
 */
class ServerService implements ServerServiceInterface
{
    public function __construct(private ServerRepositoryInterface $serverRepository) {}

    public function createServer(array $attributes): Server
    {
        return $this->serverRepository->store($attributes);
    }

    public function updateServer(array $attributes, int $id): bool
    {
        return $this->serverRepository->update($attributes, $id);
    }

    public function getAvailableServers($gpu, $cpu): Collection
    {
        return $this->serverRepository->getAvailableServers($gpu, $cpu);
    }
}