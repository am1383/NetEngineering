<?php 
declare(strict_types=1); 

namespace App\Repositories;

use App\Interfaces\Repositories\GenericRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class GenericRepository implements GenericRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function count(string $columns = 'id'): int
    {
        return $this->model->count($columns);
    }

    public function fetchAll(array $columns = ['*']): Builder
    {
        return $this->model->select($columns);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function updateOrFail(Model $model, array $attributes): bool
    {
        return $model->updateOrFail($attributes);
    }
}
