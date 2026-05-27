<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $this->userService->createUser($request->validated());

        return $this->createdResponse();
    }
}
