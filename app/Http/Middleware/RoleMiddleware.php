<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedRoleException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        throw_if(
            ! $user or $user->role !== $role,
            UnauthorizedRoleException::class
        );

        return $next($request);
    }
}
