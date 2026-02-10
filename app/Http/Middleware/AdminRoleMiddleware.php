<?php

namespace App\Http\Middleware;

use App\Exceptions\AccessErrorException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        throw_unless(
            $request->user()->isAdmin(),
            AccessErrorException::class
        );

        return $next($request);
    }
}
