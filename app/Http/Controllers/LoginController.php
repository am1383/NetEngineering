<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Interfaces\Services\LoginServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginServiceInterface $loginService
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->loginService->login(
            $request->phone_number,
            $request->password
        );

        return $this->successResponse(
            new LoginResource($data)
        );
    }
}
