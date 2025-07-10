<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\controlAsignaciones;
use App\Models\usuariosEquipos;
use App\Models\estatusCritico;

class ControlAsignacionesController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function control_asignaciones(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $controlAsignaciones = controlAsignaciones::with(['usuarioEquipo', 'estatusCritico'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('observaciones', 'like', "%$search%")
                        ->orWhereHas('usuarioEquipo', function($q) use ($search) {
                            $q->where('fecha_estatus', 'like', "%$search%");
                        })
                        ->orWhereHas('estatusCritico', function($q) use ($search) {
                            $q->where('estatus', 'like', "%$search%");
                        });
                }
            })
            ->when($timeFilter, function($query) use ($timeFilter) {
                $now = Carbon::now();

                switch ($timeFilter) {
                    case 'today':
                        $query->whereDate('fecha_asignacion', $now->toDateString());
                        break;
                    case 'this_week':
                        $query->whereBetween('fecha_asignacion', [
                            $now->copy()->startOfWeek()->toDateTimeString(),
                            $now->copy()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'this_month':
                        $query->whereBetween('fecha_asignacion', [
                            $now->copy()->startOfMonth()->toDateTimeString(),
                            $now->copy()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_week':
                        $query->whereBetween('fecha_asignacion', [
                            $now->copy()->subWeek()->startOfWeek()->toDateTimeString(),
                            $now->copy()->subWeek()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'last_month':
                        $query->whereBetween('fecha_asignacion', [
                            $now->copy()->subMonth()->startOfMonth()->toDateTimeString(),
                            $now->copy()->subMonth()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_3_months':
                        $query->where('fecha_asignacion', '>=', $now->copy()->subMonths(3)->toDateTimeString());
                        break;
                    case 'last_6_months':
                        $query->where('fecha_asignacion', '>=', $now->copy()->subMonths(6)->toDateTimeString());
                        break;
                    case 'last_year':
                        $query->where('fecha_asignacion', '>=', $now->copy()->subYear()->toDateTimeString());
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

        return view('Dashboard.controlAsignacion.control_asignaciones', [
            'control_asignaciones' => $controlAsignaciones,
            'usuarios_equipos' => usuariosEquipos::all(),
            'estatus_critico' => estatusCritico::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function control_asignaciones_registrar(Request $request)
    {
         $this->validate($request, [
        'observaciones' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
            'fecha_asignacion' => ['required','date','before_or_equal:fecha_devolucion'],
            'fecha_devolucion' => ['required','date','after_or_equal:fecha_asignacion'],
            'id_usuario_equipo' => 'required',
            'id_estatus_critico' => 'required'
        ], [
            'observaciones.required' => 'Las observaciones son obligatorias.',
            'observaciones.regex' => 'Las observaciones solo pueden contener letras y espacios.',
            'observaciones.max' => 'Las observaciones no deben exceder los 50 caracteres.',

            'fecha_asignacion.required' => 'La fecha de asignación es obligatoria.',
            'fecha_asignacion.date' => 'La fecha de asignación debe ser una fecha válida.',
            'fecha_asignacion.before_or_equal' => 'La fecha de asignación debe ser igual o anterior a la fecha de devolución.',

            'fecha_devolucion.required' => 'La fecha de devolución es obligatoria.',
            'fecha_devolucion.date' => 'La fecha de devolución debe ser una fecha válida.',
            'fecha_devolucion.after_or_equal' => 'La fecha de devolución debe ser igual o posterior a la fecha de asignación.',

            'id_usuario_equipo.required' => 'Debe seleccionar un usuario de equipo.',

            'id_estatus_critico.required' => 'Debe seleccionar un estatus crítico.'

        ]);

        controlAsignaciones::create([
            'observaciones' => $request->input("observaciones"),
            'fecha_asignacion' => $request->input("fecha_asignacion"),
            'fecha_devolucion' => $request->input("fecha_devolucion"),
            'id_usuario_equipo' => $request->input("id_usuario_equipo"),
            'id_estatus_critico' => $request->input("id_estatus_critico")
        ]);

        return redirect()->route('control_asignaciones')->with('success', 'El control de asignaciones fue creado correctamente');
    }

    //....................................................Grupo: detalle.....
    public function control_asignaciones_detalle($id)
    {
        $query = controlAsignaciones::with(['usuarioEquipo', 'estatusCritico'])->find($id);
        return view("Dashboard.controlAsignacion.control_asignaciones_detalle")
            ->with([
                'control_asignacion' => $query,
                'usuarios_equipos' => usuariosEquipos::all(),
                'estatus_critico' => estatusCritico::all()
            ]);
    }

    //.....................................................Grupos: EDITAR.....
    public function control_asignaciones_editar($id)
    {
        $query = controlAsignaciones::with(['usuarioEquipo', 'estatusCritico'])->find($id);
        return view("Dashboard.controlAsignacion.control_asignaciones_editar")
            ->with([
                'control_asignacion' => $query,
                'usuarios_equipos' => usuariosEquipos::all(),
                'estatus_critico' => estatusCritico::all()
            ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function control_asignaciones_salvar(controlAsignaciones $id, Request $request)
    {
        $this->validate($request, [
        'observaciones' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
            'fecha_asignacion' => ['required','date','before_or_equal:fecha_devolucion'],
            'fecha_devolucion' => ['required','date','after_or_equal:fecha_asignacion'],
            'id_usuario_equipo' => 'required',
            'id_estatus_critico' => 'required'
        ], [
            'observaciones.required' => 'Las observaciones son obligatorias.',
            'observaciones.regex' => 'Las observaciones solo pueden contener letras y espacios.',
            'observaciones.max' => 'Las observaciones no deben exceder los 50 caracteres.',

            'fecha_asignacion.required' => 'La fecha de asignación es obligatoria.',
            'fecha_asignacion.date' => 'La fecha de asignación debe ser una fecha válida.',
            'fecha_asignacion.before_or_equal' => 'La fecha de asignación debe ser igual o anterior a la fecha de devolución.',

            'fecha_devolucion.required' => 'La fecha de devolución es obligatoria.',
            'fecha_devolucion.date' => 'La fecha de devolución debe ser una fecha válida.',
            'fecha_devolucion.after_or_equal' => 'La fecha de devolución debe ser igual o posterior a la fecha de asignación.',

            'id_usuario_equipo.required' => 'Debe seleccionar un usuario de equipo.',

            'id_estatus_critico.required' => 'Debe seleccionar un estatus crítico.'

        ]);

        $query = controlAsignaciones::find($id->id);
        $query->observaciones = $request->observaciones;
        $query->fecha_asignacion = $request->fecha_asignacion;
        $query->fecha_devolucion = $request->fecha_devolucion;
        $query->id_usuario_equipo = $request->id_usuario_equipo;
        $query->id_estatus_critico = $request->id_estatus_critico;
        $query->save();

        return redirect()->route("control_asignaciones")->with('success', 'Control de asignaciones actualizado correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function control_asignaciones_borrar(controlAsignaciones $id)
    {
        $id->delete();
        return redirect()->route('control_asignaciones')->with('success', 'Control de asignaciones eliminado correctamente');
    }
}
