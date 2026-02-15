<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ServerRepositoryInterface;
use App\Models\Server;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ServerRepository extends GenericRepository implements ServerRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function findOrFailByUuid(string $serverUuid, array $columns = ['*']): Server
    {
        return $this->model->select($columns)
            ->where('uuid', $serverUuid)
            ->firstOrFail();
    }

    public function fetchAvailableServers(?string $gpu, ?string $cpu): Collection
    {
        return $this->model->active()
            ->when($cpu, function (Builder $q) use ($cpu): void {
                $q->whereHas('cpu', function (Builder $q) use ($cpu): void {
                    $q->where('slug', $cpu);
                });
            })
            ->when($gpu, function (Builder $q) use ($gpu): void {
                $q->whereHas('gpu', function (Builder $q) use ($gpu): void {
                    $q->where('slug', $gpu);
                });
            })->get();
    }
}
