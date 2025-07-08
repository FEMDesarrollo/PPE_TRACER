<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\usuariosEquipos;
use App\Models\estatusEquipos;
use App\Models\usuarios;
use App\Models\equipos;
use Carbon\Carbon;

class UsuariosEquiposController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function usuarios_equipos(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $usuariosEquipos = usuariosEquipos::with(['estatus_equipos', 'usuarios', 'equipos'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('comentarios', 'like', "%$search%")
                          ->orWhereHas('usuarios', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
                          })
                          ->orWhereHas('equipos', function($q) use ($search) {
                              $q->where('equipo', 'like', "%$search%");
                          });
                }
            })
            ->when($timeFilter, function($query) use ($timeFilter) {
                $now = Carbon::now();
                
                switch ($timeFilter) {
                    case 'today':
                        $query->whereDate('fecha_estatus', $now->toDateString());
                        break;
                    case 'this_week':
                        $query->whereBetween('fecha_estatus', [
                            $now->copy()->startOfWeek()->toDateTimeString(),
                            $now->copy()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'this_month':
                        $query->whereBetween('fecha_estatus', [
                            $now->copy()->startOfMonth()->toDateTimeString(),
                            $now->copy()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_week':
                        $query->whereBetween('fecha_estatus', [
                            $now->copy()->subWeek()->startOfWeek()->toDateTimeString(),
                            $now->copy()->subWeek()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'last_month':
                        $query->whereBetween('fecha_estatus', [
                            $now->copy()->subMonth()->startOfMonth()->toDateTimeString(),
                            $now->copy()->subMonth()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_3_months':
                        $query->where('fecha_estatus', '>=', $now->copy()->subMonths(3)->toDateTimeString());
                        break;
                    case 'last_6_months':
                        $query->where('fecha_estatus', '>=', $now->copy()->subMonths(6)->toDateTimeString());
                        break;
                    case 'last_year':
                        $query->where('fecha_estatus', '>=', $now->copy()->subYear()->toDateTimeString());
                        break;
                }
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'time_filter' => $timeFilter
            ]);
            
        return view('Dashboard.UsuarioEquipo.usuarios_equipos', [
            'usuarios_equipos' => $usuariosEquipos,
            'estatus_equipo' => estatusEquipos::all(),
            'usuario' => usuarios::all(),
            'equipo' => equipos::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function usuarios_equipos_registrar(Request $request)
    {
        $request->validate([
            'fecha_estatus' => 'required|date',
            'comentarios' => 'required',
            'id_estatus_equipo' => 'required',
            'id_usuario' => 'required',
            'id_equipo' => 'required'
        ]);

        usuariosEquipos::create([
            'fecha_estatus' => $request->fecha_estatus,
            'comentarios' => $request->comentarios,
            'id_estatus_equipo' => $request->id_estatus_equipo,
            'id_usuario' => $request->id_usuario,
            'id_equipo' => $request->id_equipo
        ]);

        return redirect()->route('usuarios_equipos')->with('success', 'Relación usuario-equipo registrada correctamente');
    }

    //....................................................Grupo: detalle.....
    public function usuarios_equipos_detalle($id)
    {
        $query = usuariosEquipos::with(['estatus_equipos', 'usuarios', 'equipos'])->find($id);
        return view("Dashboard.UsuarioEquipo.usuarios_equipos_detalle")
            ->with(['usuario_equipo' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function usuarios_equipos_editar($id)
    {
        $query = usuariosEquipos::with(['estatus_equipos', 'usuarios', 'equipos'])->find($id);
        return view("Dashboard.UsuarioEquipo.usuarios_equipos_editar")
            ->with([
                'usuario_equipo' => $query,
                'estatus_equipo' => estatusEquipos::all(),
                'usuario' => usuarios::all(),
                'equipo' => equipos::all()
            ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function usuarios_equipos_salvar(usuariosEquipos $id, Request $request)
    {
        $request->validate([
            'fecha_estatus' => 'required|date',
            'comentarios' => 'required',
            'id_estatus_equipo' => 'required',
            'id_usuario' => 'required',
            'id_equipo' => 'required'
        ]);

        $query = usuariosEquipos::find($id->id);
        $query->fecha_estatus = $request->fecha_estatus;
        $query->comentarios = $request->comentarios;
        $query->id_estatus_equipo = $request->id_estatus_equipo;
        $query->id_usuario = $request->id_usuario;
        $query->id_equipo = $request->id_equipo;
        $query->save();

        return redirect()->route("usuarios_equipos")->with('success', 'Relación usuario-equipo actualizada correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function usuarios_equipos_borrar(usuariosEquipos $id)
    {
        $id->delete();
        return redirect()->route('usuarios_equipos')->with('success', 'Relación usuario-equipo eliminada correctamente');
    }
}