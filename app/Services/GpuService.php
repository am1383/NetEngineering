<?php 
declare(strict_types=1);

namespace App\Services;

use App\DTOs\Pagination\PaginationDTO;
use App\Interfaces\Repositories\GpuRepositoryInterface;
use App\Interfaces\Services\GpuServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class GpuService implements GpuServiceInterface
{
    public function __construct(
        private readonly GpuRepositoryInterface $gpuRepository
    ) {}

    public function getAllGpu(PaginationDTO $dto): LengthAwarePaginator
    {
        return $this->gpuRepository->fetchAll()
            ->paginate($dto->perPage, page: $dto->page);
    }
}
