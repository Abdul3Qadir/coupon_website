<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'brand.verified' => \App\Http\Middleware\EnsureBrandEmailIsVerified::class,
            'admin.verified' => \App\Http\Middleware\EnsureAdminEmailIsVerified::class,
        ]);

        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            if ($request->is('brand/*')) {
                return route('brand.login');
            }

            return '/';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
