<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array((string) $user->id_perfil, $roles)) {
            return response()->view('errors.permiso-denegado', [], 403);
        }

        return $next($request);
    }
}