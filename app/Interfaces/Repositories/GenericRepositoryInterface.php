<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Model;

interface GenericRepositoryInterface
{
    
    public function find(int $id): ?Model;

    public function findOrFail(int $id): Model;

    public function store(array $attributes): Model;

    public function update(array $attributes, int $id): bool;

    public function delete(int $id): ?bool;
}