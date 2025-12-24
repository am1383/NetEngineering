<?php

namespace App\Repositories;

use GenericRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GenericRepository implements GenericRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function store(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, int $id): bool
    {
        return $this->model->find($id)
            ->update($attributes);
    }

    public function delete(int $id): ?bool
    {
        return $this->model->find($id)
            ->delete();
    }
}
