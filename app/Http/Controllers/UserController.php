<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;

class UserController
{
    public function __construct(private UserServiceInterface $userService) {}

    public function store(UserRequest $request) 
    {
        return $this->userService
            ->createUser($request->validated());
    }

    public function update(UserRequest $request, User $user) 
    {
        return $this->userService
            ->updateUser($request->validated(), $user->id);
    }

    public function show(User $user) 
    {
        return $this->userService
            ->getUserInformationById($user->id);
    }
}
