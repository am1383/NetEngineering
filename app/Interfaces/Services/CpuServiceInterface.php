<?php 
declare(strict_types=1);

namespace App\Interfaces\Services;

use App\DTOs\Pagination\PaginationDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface CpuServiceInterface
{
    public function getAllCpu(PaginationDTO $dto): LengthAwarePaginator;
}
