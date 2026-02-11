<?php

namespace App\Interfaces\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface GpuServiceInterface
{
    public function getAllGpu(int $perPage, int $page): LengthAwarePaginator;
}
