<?php 
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\Services\UserServiceInterface;

use Illuminate\Http\{
    JsonResponse,
    Response
};

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService
    ) {}

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        return $this->successResponse(new UserResource(
            $this->userService->createUser($request->validated())),
            Response::HTTP_CREATED
        );
    }
}
