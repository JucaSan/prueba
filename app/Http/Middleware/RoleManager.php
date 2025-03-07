<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Definimos constantes para los roles, lo que facilita su uso y mejora la legibilidad.
     */
    const ROLE_ADMIN = 1;
    const ROLE_GUARDIA = 2;
    const ROLE_RECEPCIONISTA = 3;
    const ROLE_ENCARGADO_SUCURSAL = 4;
    const ROLE_LOGISTICA = 5;
    const ROLE_MONITORISTA = 6;

    /**
     * Maneja una solicitud entrante y verifica si el usuario tiene el rol necesario.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud actual
     * @param  \Closure  $next  La siguiente acción en la cadena de middleware
     * @param  string  $role  El rol requerido para acceder a la ruta
     * @return \Symfony\Component\HttpFoundation\Response  Redirección o acceso permitido
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirige al login si no ha iniciado sesión
        }

        // Obtiene el rol del usuario autenticado
        $authUserRole = Auth::user()->role;

        // Compara el rol requerido con el rol del usuario
        switch ($role) {
            case 'admin':
                if ($authUserRole == self::ROLE_ADMIN) {
                    return $next($request); // Permite el acceso si es administrador
                }
                break;
            case 'guardia':
                if ($authUserRole == self::ROLE_GUARDIA) {
                    return $next($request); // Permite el acceso si es guardia
                }
                break;
            case 'recepcionista':
                if ($authUserRole == self::ROLE_RECEPCIONISTA) {
                    return $next($request); // Permite el acceso si es recepcionista
                }
                break;
            case 'encargado_sucursal':
                if ($authUserRole == self::ROLE_ENCARGADO_SUCURSAL) {
                    return $next($request); // Permite el acceso si es administrador
                }
                break;
            case 'logistica':
                if ($authUserRole == self::ROLE_LOGISTICA) {
                    return $next($request); // Permite el acceso si es guardia
                }
                break;
            case 'monitorista':
                if ($authUserRole == self::ROLE_MONITORISTA) {
                    return $next($request); // Permite el acceso si es recepcionista
                }
                break;
        }

        // Si el usuario no tiene el rol adecuado, lo redirige a la página de inicio
        return redirect()->route('home');
    }
}
