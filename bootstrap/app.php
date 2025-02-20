<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'member' => \App\Http\Middleware\Member::class, // Fixed typo: 'mamber' to 'member'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // You can add exception handling logic here
    })->create();
