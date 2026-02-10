<?php

namespace App\Services;

use App\Interfaces\Repositories\CpuRepositoryInterface;
use App\Interfaces\Services\CpuServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CpuService implements CpuServiceInterface
{
    public function __construct(
        private readonly CpuRepositoryInterface $cpuRepository
    ) {}

    public function getAllCpu(int $perPage, int $page): LengthAwarePaginator
    {
        return $this->cpuRepository
            ->queryFetchAll()
            ->paginate(perPage: $perPage, page: $page);
    }
}
