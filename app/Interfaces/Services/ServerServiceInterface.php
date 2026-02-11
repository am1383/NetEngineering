<?php

namespace App\Interfaces\Services;

use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerServiceInterface
{
    public function createServer(array $attributes): Server;

    public function updateServer(array $attributes, Server $server): bool;

    public function getAvailableServers(?string $gpu, ?string $cpu): Collection;
}
