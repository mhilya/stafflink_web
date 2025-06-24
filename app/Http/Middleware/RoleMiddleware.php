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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $userRole = strtolower(auth()->user()->role?->name);
        $normalizedRoles = array_map('strtolower', $roles);

        if (!$userRole || !in_array($userRole, $normalizedRoles)) {
            abort(403, 'Unauthorized: Access denied for role [' . ($userRole ?? 'unknown') . ']');
        }

        return $next($request);
    }
}
