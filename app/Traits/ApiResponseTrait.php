<?php 
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\{
    JsonResponse,
    Response
};

trait ApiResponseTrait
{
    protected function successResponse(mixed $data = null, int $status = Response::HTTP_OK, string $message = ''): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (! is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }
}
