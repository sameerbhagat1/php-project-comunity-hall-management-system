<?php

namespace App\Http\Middleware;

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
        if (!$request->user()) {
            abort(403, 'Unauthorized.');
        }

        // Allow admin to access everything or if role matches
        if ($request->user()->role === 'admin' || $request->user()->role === $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}
