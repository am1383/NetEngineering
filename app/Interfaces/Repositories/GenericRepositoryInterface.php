<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\DTOs\Pagination\PaginationDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface GenericRepositoryInterface
{
    public function count(): int;

    public function paginate(PaginationDTO $dto, array $columns = ['*']): LengthAwarePaginator;

    public function create(array $attributes): Model;

    public function updateOrFail(Model $model, array $attributes): void;
}
