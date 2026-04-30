<?php 
declare(strict_types=1);

namespace App\Policies;

use App\Enums\RoleType;
use App\Models\User;

class IsAdminPolicy
{
    public function isAdmin(User $user): bool
    {
        return $user->role_id === RoleType::ADMIN->value;
    }
}
