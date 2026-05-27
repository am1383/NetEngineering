<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerServiceInterface
{
    public function createServer(array $attributes): void;

    public function updateServer(Server $server, array $attributes): void;

    public function getAvailableServers(?string $gpu, ?string $cpu): Collection;
}
