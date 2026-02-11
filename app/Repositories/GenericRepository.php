<?php

namespace App\Repositories;

use App\Interfaces\Repositories\GenericRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GenericRepository implements GenericRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function count(string $columns = 'id'): int
    {
        return $this->model->count($columns);
    }

    public function queryFetchAll(array $columns = ['*']): Builder
    {
        return $this->model->select($columns);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, Model $model): bool
    {
        return $model->update($attributes);
    }
}
