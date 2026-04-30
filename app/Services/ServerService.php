<?php 
declare(strict_types=1);

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
        return $this->serverRepository->create($attributes);
    }

    public function updateServer(Server $server, array $attributes): bool
    {
        return $this->serverRepository->updateOrFail($server, $attributes);
    }

    public function getAvailableServers(?string $gpu, ?string $cpu): Collection
    {
        return $this->serverRepository->fetchAvailableServers($gpu, $cpu);
    }
}
