<?php

use App\Http\Middleware\AdminRoleMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => AdminRoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ModelNotFoundException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.not_found'),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.method_not_allowed'),
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        });

        $exceptions->render(function (AuthenticationException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.unauthenticated'),
            ], Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->render(function (AuthorizationException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.unauthorized'),
            ], Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->render(function (QueryException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.internal_server_error'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });

        $exceptions->render(function (\Throwable $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.internal_server_error'),
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();
