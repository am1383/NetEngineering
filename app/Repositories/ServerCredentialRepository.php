<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ServerCredentialRepository extends GenericRepository implements ServerCredentialRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function assignCredentials(int $reservationId, string $userName, string $password): void
    {
        $this->model->updateOrCreate([
            'reservation_id' => $reservationId,
        ],
            [
                'username' => $userName,
                'password' => $password,
            ]);
    }
}
