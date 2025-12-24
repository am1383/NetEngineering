<?php 

namespace App\Interfaces\Services;

use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerServiceInterface
{
    public function createServer(array $attributes): Server;

    public function updateServer(array $attributes, int $id): bool;

    public function getAvailableServers($gpu, $cpu): Collection;
}