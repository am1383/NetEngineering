<?php 
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends GenericRepository implements UserRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    ) {}

    public function findUserByPhoneNumber(string $phoneNumber): ?User
    {
        return $this->model->where('phone_number', $phoneNumber)
            ->first();
    }
}
