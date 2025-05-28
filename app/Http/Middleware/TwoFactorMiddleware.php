<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Facades\Auth;


class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */    /**
     * Maneja la verificación del código 2FA
     *
     * Este middleware:
     * 1. Verifica si 2FA está activo en la aplicación
     * 2. Comprueba si el usuario necesita verificar un código
     * 3. Valida si el código ha expirado
     * 4. Redirige a la página de verificación si es necesario
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Si no hay usuario o 2FA está desactivado, permite el acceso
        if (!$user || !env('TWO_FACTOR_AUTH_ENABLED', false)) {
            return $next($request);
        }

        // Si el usuario tiene un código pendiente de verificar
        if ($user->two_factor_code) {
            // Verifica si el código ha expirado
            if ($user->two_factor_expires_at < now()) {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('login')
                    ->withMessage('El código de verificación ha expirado. Por favor, inicia sesión de nuevo.');
            }

            // Redirige a la página de verificación si no estamos ya en ella
            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }
    if ($user && $user->two_factor_code) {
            if ($user->two_factor_expires_at < now()) {
                $user->resetTwoFactorCode();
                auth()->logout();
                return redirect()->route('/')
                    ->withStatus('Your verification code expired. Please re-login.');
            }
            if (!$request->is('verify*')) {
                return redirect()->route('verify.index');
            }
        }
        return $next($request);

    }

}
