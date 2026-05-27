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

    public function paginate(PaginationDTO $dto): LengthAwarePaginator
    {
        return $this->gpuRepository->paginate($dto);
    }
}
