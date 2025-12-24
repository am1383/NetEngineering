<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ConfilictException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('errors.time_slot_unavailable'),
        ], 422);
    }
}
