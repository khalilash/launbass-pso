<?php



namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Minimal CSRF middleware placeholder.
 *
 * NOTE: This implementation does NOT perform CSRF verification.
 * It's provided so your project runs without the full Laravel CSRF
 * implementation. Replace with real verification before production.
 */
class VerifyCsrfToken
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // passthrough for now
        return $next($request);
    }
}
