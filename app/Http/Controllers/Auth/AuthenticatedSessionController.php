<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Definimos constantes para los roles de usuario, facilitando su identificación y uso.
     */
    const ROLE_ADMIN = 1;
    const ROLE_GUARDIA = 2;
    const ROLE_RECEPCIONISTA = 3;
    const ROLE_ENCARGADO_SUCURSAL = 4;
    const ROLE_LOGISTICA = 5;
    const ROLE_MONITORISTA = 6;

    /**
     * Muestra la vista de inicio de sesión.
     *
     * @return \Illuminate\View\View La vista del formulario de login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Maneja una solicitud de autenticación entrante.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request  La solicitud de inicio de sesión.
     * @return \Illuminate\Http\RedirectResponse  Redirección a la ruta correspondiente según el rol del usuario.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica las credenciales del usuario
        $request->authenticate();

        // Regenera la sesión para evitar ataques de fijación de sesión
        $request->session()->regenerate();

        // Obtiene el rol del usuario autenticado
        $authUserRole = Auth::user()->role;

        // Redirige al usuario a la ruta correspondiente según su rol
        switch ($authUserRole) {
            case self::ROLE_ADMIN:
                return redirect()->intended(route('dashboard', absolute: false));
            case self::ROLE_GUARDIA:
                return redirect()->intended(route('guardia', absolute: false));
            case self::ROLE_RECEPCIONISTA:
                return redirect()->intended(route('recepcionista', absolute: false));
            case self::ROLE_ENCARGADO_SUCURSAL:
                    return redirect()->intended(route('encargado_sucursal', absolute: false));
            case self::ROLE_LOGISTICA:
                    return redirect()->intended(route('logistica', absolute: false));
            case self::ROLE_MONITORISTA:
                    return redirect()->intended(route('monitorista', absolute: false));
            default:
                return redirect()->route('home'); // Redirige a la página principal si el rol no coincide
        }
    }

    /**
     * Cierra la sesión de un usuario autenticado.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse  Redirección a la página de inicio.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cierra la sesión del usuario autenticado
        Auth::guard('web')->logout();

        // Invalida la sesión actual para mayor seguridad
        $request->session()->invalidate();

        // Regenera el token CSRF para evitar ataques de falsificación de solicitud
        $request->session()->regenerateToken();

        // Redirige a la página de inicio
        return redirect('/');
    }
}
