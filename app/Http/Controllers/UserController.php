<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userService
            ->createUser($request->validated());

        return $this->successResponse(
            new UserResource($user),
            status: 201
        );
    }

    public function update(UserRequest $request): JsonResponse
    {
        return $this->successResponse(
            $this->userService
                ->updateUser($request->validated())
        );
    }

    public function edit(): JsonResponse
    {
        $user = $this->userService
            ->getUserInformation();

        return $this->successResponse(
            new UserResource($user)
        );
    }
}
