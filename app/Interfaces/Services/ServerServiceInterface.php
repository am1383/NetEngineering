<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerServiceInterface
{
    public function createServer(array $attributes): Server;

    public function updateServer(Server $server, array $attributes): bool;

    public function getAvailableServers(?string $gpu, ?string $cpu): Collection;
}
