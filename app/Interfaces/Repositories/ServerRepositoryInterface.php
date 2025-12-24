<?php

namespace App\Interfaces\Repositories;

use GenericRepositoryInterface;
use Illuminate\Support\Collection;

interface ServerRepositoryInterface extends GenericRepositoryInterface
{
    public function getAvailableServers($gpu, $cpu): Collection;
}