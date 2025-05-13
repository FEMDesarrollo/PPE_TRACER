<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth as RulesRequest;
use App\Models\Usuario;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(RulesRequest\Login $request)
    {
        // dd($request->all()); 
        $usuario = Usuario::query()
        ->where('correo', $request->correo)
        ->with(['verificacionCorreo',
        'perfil'])
        ->first();

        $datos = [
            'correo' => $usuario->correo,
            'password' => $request->password,

        ];

        if (Auth::attempt($datos)) {
            $request->session()->regenerate();
            return redirect()->to('/dashboard');
            
        }else{
            if (!Hash::check($request->contrasena, $usuario->password)) {
                return back()->with('error', 'La contraseña es incorrecta');
            }
            if (!$usuario->verificacionCorreo->codigo_verificacion) {
                Auth::logout();
                return back()->with('error', 'Tu correo no ha sido validado');
            }
            }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login')->with('message', 'Sesión cerrada correctamente');
    }
}
