<?php

namespace App\Repositories;

use App\Interfaces\Repositories\GpuRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GpuRepository extends GenericRepository implements GpuRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}
}
