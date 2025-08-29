<?php

use App\Http\Middleware\authorized;
use App\Http\Middleware\isIndividual;
use App\Http\Middleware\isorganization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'authorized'=>authorized::class,
            'isOrganization'=>isorganization::class,
            'isIndividual'=>isIndividual::class
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
