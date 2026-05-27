<?php 
declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\{
    JsonResponse,
    Response
};

trait ApiResponseTrait
{
    protected function successResponse(mixed $data = null, string $message = ''): JsonResponse
    {
        return response()->json(
            $this->response($data, $message),
            Response::HTTP_OK
        );
    }

    public function createdResponse(mixed $data = null, string $message = ''): JsonResponse
    {
        return response()->json(
            $this->response($data, $message),
            Response::HTTP_CREATED
        );
    }

    public function noContentResponse(mixed $data = null, string $message = ''): JsonResponse
    {
        return response()->json(
            $this->response($data, $message),
            Response::HTTP_NO_CONTENT
        );
    }

    private function response(mixed $data, string $message): array
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (! is_null($data)) {
            $response['data'] = $data;
        }

        return $response;
    }
}
