<?php

namespace App\Http\Controllers;

use App\DTOs\Pagination\PaginationDTO;
use App\Http\Requests\PaginationRequest;
use App\Http\Resources\CpuResource;
use App\Interfaces\Services\CpuServiceInterface;
use Illuminate\Http\JsonResponse;

class CpuController extends Controller
{
    public function __construct(
        private readonly CpuServiceInterface $cpuService
    ) {}

    public function index(PaginationRequest $request): JsonResponse
    {
        $dto = PaginationDTO::fromRequest($request->validated());

        return $this->successResponse(CpuResource::collection(
            $this->cpuService
                ->getAllCpu($dto->perPage, $dto->page),
        ));
    }
}
