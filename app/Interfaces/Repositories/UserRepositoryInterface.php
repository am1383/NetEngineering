<?php 
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\User;

interface UserRepositoryInterface extends GenericRepositoryInterface
{
    public function findUserByPhoneNumber(string $phoneNumber): ?User;
}
