<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Minimal Authenticate middleware that uses session('user_id').
 * If not present, redirect to /login (or return 401 for AJAX).
 */
class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (! session()->has('user_id')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
            return redirect('/login');
        }

        return $next($request);
    }
}
