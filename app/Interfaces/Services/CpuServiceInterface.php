<?php

namespace App\Interfaces\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface CpuServiceInterface
{
    public function getAllCpu(int $perPage, int $page): LengthAwarePaginator;
}
