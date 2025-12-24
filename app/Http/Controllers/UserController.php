<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;

class UserController
{
    public function __construct(private UserServiceInterface $userService) {}

    public function store(UserRequest $request) {}

    public function update(UserRequest $request, User $user) {}

    public function show(User $user) {}
}
