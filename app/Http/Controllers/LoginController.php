<?php 
declare(strict_types=1);

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
        return $this->successResponse($this->loginService
            ->login($request->phone_number, $request->password)
        );
    }
}
