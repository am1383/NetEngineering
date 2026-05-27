<?php 
declare(strict_types=1);

namespace App\Services;

use App\DTOs\Pagination\PaginationDTO;
use App\Interfaces\Repositories\CpuRepositoryInterface;
use App\Interfaces\Services\CpuServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CpuService implements CpuServiceInterface
{
    public function __construct(
        private readonly CpuRepositoryInterface $cpuRepository
    ) {}

    public function paginate(PaginationDTO $dto): LengthAwarePaginator
    {
        return $this->cpuRepository->paginate($dto);
    }
}
