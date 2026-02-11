<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface GenericRepositoryInterface
{
    public function count(string $columns = '*'): int;

    public function queryFetchAll(array $columns = ['*']): Builder;

    public function findOrFail(int $id): Model;

    public function store(array $attributes): Model;

    public function update(array $attributes, Model $model): bool;
}
