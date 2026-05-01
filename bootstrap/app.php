<?php 
declare(strict_types=1);

use App\Http\Middleware\EnsureAdmin;
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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => EnsureAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (ModelNotFoundException|NotFoundHttpException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.not_found'),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->renderable(function (MethodNotAllowedHttpException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.method_not_allowed'),
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        });

        $exceptions->renderable(function (AuthenticationException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.unauthenticated'),
            ], Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->renderable(function (AuthorizationException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.unauthorized'),
            ], Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->renderable(function (QueryException $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.try_again_later'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });

        $exceptions->renderable(function (\Throwable $e, $request): JsonResponse {
            return response()->json([
                'message' => __('errors.try_again_later'),
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })->create();
