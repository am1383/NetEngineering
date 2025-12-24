<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\LoginServiceInterface;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController
{
    use ApiResponseTrait;

    public function __construct(private LoginServiceInterface $loginService) {}

    public function login(LoginRequest $request): JsonResponse 
    {
        $data = $this->loginService->login(
            $request->phone_number,
            $request->password
        );

        return $this->successResponse(new UserResource($data));
    }
}
