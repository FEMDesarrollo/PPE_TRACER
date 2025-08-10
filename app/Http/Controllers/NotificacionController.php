<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    /**
     * Limpia todas las notificaciones del usuario autenticado.
     */
    public function limpiar()
    {
        Notificacion::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Todas las notificaciones fueron eliminadas.');
    }

    
}
