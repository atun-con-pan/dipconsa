<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // formulario para pedir email
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', '¡Listo! Revisa tu correo para continuar con el restablecimiento de contraseña.');
        }

        if ($status === Password::RESET_THROTTLED) {
            return back()->withErrors(['email' => 'Por favor espera unos minutos antes de intentar nuevamente.']);
        }

        if ($status === Password::INVALID_USER) {
            return back()->withErrors(['email' => 'No encontramos ningún usuario registrado con ese correo.']);
        }

        return back()->withErrors(['email' => __($status)]);
    }

}