<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Middleware para asegurar que el usuario esté autenticado.
 *
 * Si el usuario no está autenticado, lo redirige a la ruta de login.
 * Extiende el middleware de autenticación de Laravel.
 */
class Authenticate extends Middleware
{
    /**
     * Maneja una solicitud entrante.
     *
     * Si el usuario no está autenticado y la solicitud no espera JSON,
     * redirige a la ruta de login.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @return string|null  La ruta de redirección o null si no aplica.
     */
    protected function redirectTo($request)
    {
        // Si la solicitud no espera una respuesta JSON, redirige al login
        if (!$request->expectsJson()) {
            return route('loginForm');
        }
    }
}
