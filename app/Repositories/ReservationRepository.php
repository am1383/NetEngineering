<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class ReservationRepository extends GenericRepository
{
    public function __construct(protected Model $model) {}
}