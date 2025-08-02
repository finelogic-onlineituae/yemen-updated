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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'email.verified' => \App\Http\Middleware\EnsureEmailIsVerified::class
        ]);
    })
     ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user.check' => \App\Http\Middleware\UserCheckApllication::class
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'signature.uploaded' => \App\Http\Middleware\EnsureSignatureUploaded::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
