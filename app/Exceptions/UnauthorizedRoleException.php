<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Exception;

class UnauthorizedRoleException extends Exception
{
    public function render(): Response
    {
        return response()->json([
            'message' => __('errors.access_error'),
        ], 403);
    }
}
