<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware para verificar el tipo de usuario autenticado.
 *
 * Si el usuario autenticado tiene el rol especificado, lo redirige a la ruta de pagos principal.
 */
class CheckUserType
{
    /**
     * Maneja una solicitud entrante y verifica el tipo de usuario.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @param  \Closure  $next  El siguiente middleware o controlador.
     * @param  mixed  $type  El tipo de rol requerido para acceder.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$type): Response
    {
        $allowedTypes = array_map('intval', $type);

        // Verifica si el usuario autenticado con el guard 'usuario' tiene el rol requerido
        if(Auth::guard('usuario')->check() && !in_array(Auth::guard('usuario')->user()->id_rol, $allowedTypes, true)) {
            // Si el usuario no tiene el rol, lo redirige a la página principal de pagos
            return redirect()->route('main');
        }

        // Si no, continúa con la solicitud
        return $next($request);
    }
}