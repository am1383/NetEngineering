<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface GenericRepositoryInterface
{
    public function count(string $columns = '*'): int;

    public function fetchAll(array $columns = ['*']): Builder;

    public function create(array $attributes): Model;

    public function updateOrFail(Model $model, array $attributes): bool;
}
