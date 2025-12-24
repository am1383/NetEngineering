<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UserController
{
    use ApiResponseTrait;

    public function __construct(private UserServiceInterface $userService) {}

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userService
            ->createUser($request->validated());

        return $this->successResponse(new UserResource($user), status: 201);
    }

    public function update(UserRequest $request, User $user): JsonResponse 
    {
        $data = $this->userService
            ->updateUser($request->validated(), $user->id);

        return $this->successResponse($data);
    }

    public function show(User $user): JsonResponse 
    {
        $user =  $this->userService
            ->getUserInformationById($user->id);
        
        return $this->successResponse(new UserResource($user));
    }
}
