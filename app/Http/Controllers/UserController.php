<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
            status: Response::HTTP_CREATED
        );
    }

    public function update(UserRequest $request): JsonResponse
    {
        return $this->successResponse(
            $this->userService
                ->updateUser($request->validated())
        );
    }

    public function show(): JsonResponse
    {
        $user = $this->userService
            ->getUserInformation();

        return $this->successResponse(
            new UserResource($user)
        );
    }
}
