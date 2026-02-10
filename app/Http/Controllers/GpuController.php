<?php

namespace App\Http\Controllers;

use App\DTOs\Pagination\PaginationDTO;
use App\Http\Requests\PaginationRequest;
use App\Http\Resources\GpuResource;
use App\Interfaces\Services\GpuServiceInterface;
use Illuminate\Http\JsonResponse;

class GpuController extends Controller
{
    public function __construct(
        private readonly GpuServiceInterface $gpuService
    ) {}

    public function index(PaginationRequest $request): JsonResponse
    {
        $dto = PaginationDTO::fromRequest($request->validated());

        return $this->successResponse(GpuResource::collection(
            $this->gpuService
                ->getAllGpu($dto->perPage, $dto->page),
        ));
    }
}
