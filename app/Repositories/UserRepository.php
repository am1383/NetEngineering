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

    public function findUserByPhoneNumber(string $phoneNumber, array $columns = ['*']): ?User
    {
        return $this->model->select($columns)
            ->firstWhere('phone_number', $phoneNumber);
    }
}
