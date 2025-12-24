<?php

namespace App\Response;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class ValidationResponse implements Responsable
{
    public function __construct(private MessageBag $errors) {}

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse([
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'result' => [
                'message' => __('validation.errors'),
                'errors' => $this->errors->toArray(),
            ],
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
