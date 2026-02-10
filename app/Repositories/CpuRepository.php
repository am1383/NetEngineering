<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CpuRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CpuRepository extends GenericRepository implements CpuRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}
}
