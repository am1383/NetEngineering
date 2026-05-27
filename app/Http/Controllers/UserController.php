<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    public function store(UserRequest $request): JsonResponse
    {
        $this->userService->createUser($request->validated());

        return $this->createdResponse();
    }
}
