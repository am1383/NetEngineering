<?php

namespace App\Repositories;

use App\DTOs\ServerCredential\AssignServerCredentialDTO;
use App\Interfaces\Repositories\ServerCredentialRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ServerCredentialRepository extends GenericRepository implements ServerCredentialRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function assignCredentials(AssignServerCredentialDTO $dto): void
    {
        $this->model->updateOrCreate([
            'reservation_id' => $dto->reservationId,
        ],
            [
                'username' => $dto->userName,
                'password' => $dto->password,
            ]);
    }
}
