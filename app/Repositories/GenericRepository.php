<?php 
declare(strict_types=1); 

namespace App\Repositories;

use App\DTOs\Pagination\PaginationDTO;
use App\Interfaces\Repositories\GenericRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class GenericRepository implements GenericRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function count(): int
    {
        return $this->model->count();
    }

    public function paginate(PaginationDTO $dto, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->select($columns)
            ->paginate($dto->perPage, page: $dto->page);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function updateOrFail(Model $model, array $attributes): void
    {
        $model->updateOrFail($attributes);
    }
}
