<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class ServerCredentialRepository
{
    public function __construct(protected Model $model) {}
}