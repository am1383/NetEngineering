<?php

namespace App\Interfaces\Repositories;

use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerRepositoryInterface extends GenericRepositoryInterface
{
    public function getAvailableServers(?string $gpu, ?string $cpu): Collection;

    public function findOrFailByUuid(string $serverUuid): Server;
}
