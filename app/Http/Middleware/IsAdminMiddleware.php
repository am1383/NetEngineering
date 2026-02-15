<?php

namespace App\Http\Middleware;

use App\Exceptions\AccessErrorException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        throw_if(
            Gate::denies('is-admin'),
            AccessErrorException::class
        );

        return $next($request);
    }
}
