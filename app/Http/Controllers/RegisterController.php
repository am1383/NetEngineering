<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __construct(private UserServiceInterface $userService) {}

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $this->userService->createUser(
            $request->validated()
        );

        return $this->successResponse(status: Response::HTTP_CREATED);
    }
}
