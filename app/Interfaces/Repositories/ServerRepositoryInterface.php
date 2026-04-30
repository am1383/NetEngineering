<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\Server;
use Illuminate\Support\Collection;

interface ServerRepositoryInterface extends GenericRepositoryInterface
{
    public function fetchAvailableServers(?string $gpu, ?string $cpu): Collection;

    public function findOrFailByUlid(string $ulid, array $columns = ['*']): Server;
}
