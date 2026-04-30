<?php 
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\{
    JsonResponse,
    Response
};

class InvalidCredentialsException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('errors.invalid_credentials_error'),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
