<?php

namespace App\Interfaces\Repositories;

use Illuminate\Foundation\Auth\User as Authenticatable;

interface UserRepositoryInterface extends GenericRepositoryInterface
{
    public function store(array $attributes): Authenticatable;

    public function update(array $attributes, int $id): bool;
}
