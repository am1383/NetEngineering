<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AccessErrorException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('errors.access_error'),
        ], 403);
    }
}
