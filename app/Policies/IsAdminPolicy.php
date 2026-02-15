<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;

class IsAdminPolicy
{
    public function isAdmin(User $user): bool
    {
        return $user->role_id === RoleEnum::ADMIN->value;
    }
}
