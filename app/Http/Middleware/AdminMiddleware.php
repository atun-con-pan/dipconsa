<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica que el usuario esté autenticado y que sea admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Si no es admin, aborta con 403 (prohibido)
        abort(403, 'No tienes permiso para acceder a esta página.');
    }
}

