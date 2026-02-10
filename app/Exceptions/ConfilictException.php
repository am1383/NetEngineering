<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ConfilictException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('errors.time_slot_unavailable'),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
