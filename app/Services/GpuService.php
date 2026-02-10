<?php

namespace App\Services;

use App\Interfaces\Repositories\GpuRepositoryInterface;
use App\Interfaces\Services\GpuServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GpuService implements GpuServiceInterface
{
    public function __construct(
        private readonly GpuRepositoryInterface $gpuRepository
    ) {}

    public function getAllGpu(int $perPage, int $page): LengthAwarePaginator
    {
        return $this->gpuRepository
            ->queryFetchAll()
            ->paginate(perPage: $perPage, page: $page);
    }
}
