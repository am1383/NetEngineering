<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Repositories\GenericRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ServerRepository extends GenericRepository implements ServerRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function getAvailableServers($gpu, $cpu): Collection
    {
        return $this->model->active()
            ->when($gpu, fn($q) => $q->where('gpu', $gpu))
            ->when($cpu, fn($q) => $q->where('cpu', $cpu))
            ->get();
    }
}