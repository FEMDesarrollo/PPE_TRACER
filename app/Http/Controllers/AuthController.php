<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth as RulesRequest;
use App\Models\usuarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;  // <-- Importar Request aquí

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $usuario = usuarios::where('correo', $request->correo)->first();

        if (!$usuario) {
            return back()->with('error', 'El correo no está registrado');
        }

        if (!$usuario->correo_verificado) {
            return back()->with('error', 'Tu correo no ha sido validado');
        }

        $credentials = $request->only('correo', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Guardar el id del usuario en sesión para el middleware
            session(['usuario_id' => Auth::id()]);
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'La contraseña es incorrecta');
    }

    public function logout()
    {
        session()->flush(); // Elimina toda la sesión
        return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
    }

}
