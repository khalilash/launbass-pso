<?php

// NRP: 5026231227| Nama: Arjuna Veetaraq

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     *
     * Keep minimal to avoid referencing missing classes.
     *
     * @var array
     */
    protected $middleware = [
        // Intentionally minimal. Add entries here only if corresponding classes exist.
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Common middleware likely present in the framework
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            // CSRF protection if VerifyCsrfToken exists in App\Http\Middleware
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware.
     *
     * Map aliases to classes that should exist in your project.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Keep only the aliases you actually use
        'auth' => \App\Http\Middleware\Authenticate::class,
        'ensure.loggedin' => \App\Http\Middleware\EnsureLoggedIn::class,
    ];
}
