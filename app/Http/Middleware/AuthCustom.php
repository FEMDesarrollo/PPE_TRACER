<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthCustom
{
    public function handle($request, Closure $next)
{
    if (!session()->has('usuario_id')) {
        return redirect('/login')->with('error', 'Debes iniciar sesión.');
    }

    return $next($request);
}
}
