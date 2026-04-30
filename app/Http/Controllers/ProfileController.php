<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    public function update(UserRequest $request): JsonResponse
    {
        return $this->successResponse($this->userService
            ->updateUser($request->validated())
        );
    }

    public function show(): JsonResponse
    {
        return $this->successResponse(
            new UserResource(auth()->user())
        );
    }
}
