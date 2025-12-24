<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends GenericRepository implements UserRepositoryInterface
{
    public function __construct(protected Model $model) {}
}
