<?php

use App\Http\Middleware\CheckUserType;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use function Pest\Laravel\withMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Registra el middleware 'check.user.type', que asocia el alias con la clase CheckUserType.
        // Este middleware puede usarse en rutas o controladores para verificar el tipo de usuario autenticado.
        $middleware->alias([
            'check.user.type' => CheckUserType::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();