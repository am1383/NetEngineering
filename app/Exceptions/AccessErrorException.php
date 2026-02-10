<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AccessErrorException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('errors.access_error'),
        ], Response::HTTP_FORBIDDEN);
    }
}
