<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ServerCredentialRepository extends GenericRepository implements ServerCredentialRepositoryInterface
{
    public function __construct(protected Model $model) {}
}