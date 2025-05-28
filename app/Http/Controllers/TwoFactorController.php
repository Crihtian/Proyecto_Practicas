<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\SendTwoFactorCode;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


/**
 * Controlador para manejar la verificación de dos factores (2FA)
 * Se encarga de mostrar el formulario de verificación, validar códigos y reenviar códigos
 */
class TwoFactorController extends Controller
{
    /**
     * Muestra el formulario para introducir el código de verificación
     */
    public function index(): View
    {
        return view('auth.twoFactor');
    }

    /**
     * Valida el código de verificación introducido por el usuario
     * Si es correcto, resetea el código y redirige al dashboard
     * Si no es correcto, devuelve al formulario con un error
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'two_factor_code' => ['required', 'numeric']  // El código debe ser numérico
        ]);

        $user = auth()->user();

        if ($request->input('two_factor_code') != $user->two_factor_code) {
            throw ValidationException::withMessages([
                'two_factor_code' => __('El código introducido no coincide.')
            ]);
        }

        $user->resetTwoFactorCode();
        return redirect()->intended('/dashboard');
    }
    /**
     * Reenvía un nuevo código de verificación al usuario
     * Útil cuando el código anterior ha expirado o no ha llegado
     */
    public function resend(): RedirectResponse
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();  // Genera un nuevo código
        $user->notify(new SendTwoFactorCode());  // Envía el nuevo código por email
        return redirect()->back()->withStatus(__('Se ha enviado un nuevo código'));
    }
}


