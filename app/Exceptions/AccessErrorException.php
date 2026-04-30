<?php 
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\{
    JsonResponse,
    Response
};

class AccessErrorException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => __('errors.access_error'),
        ], Response::HTTP_FORBIDDEN);
    }
}
