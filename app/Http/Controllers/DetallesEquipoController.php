<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\detallesEquipo;
use App\Models\usuariosEquipos;
use Carbon\Carbon;

class DetallesEquipoController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function detalles_equipos(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $detallesEquipos = detallesEquipo::with('usuarios_equipos')
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('no_serie', 'like', "%$search%");
                } else {
                    $query->where('modelo', 'like', "%$search%")
                          ->orWhere('no_serie', 'like', "%$search%")
                          ->orWhere('talla', 'like', "%$search%")
                          ->orWhereHas('usuarios_equipos', function($q) use ($search) {
                              $q->whereHas('equipos', function($q2) use ($search) {
                                  $q2->where('equipo', 'like', "%$search%");
                              });
                          });
                }
            })
            ->when($timeFilter, function($query) use ($timeFilter) {
                $now = Carbon::now();
                
                switch ($timeFilter) {
                    case 'today':
                        $query->whereDate('created_at', $now->toDateString());
                        break;
                    case 'this_week':
                        $query->whereBetween('created_at', [
                            $now->copy()->startOfWeek()->toDateTimeString(),
                            $now->copy()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'this_month':
                        $query->whereBetween('created_at', [
                            $now->copy()->startOfMonth()->toDateTimeString(),
                            $now->copy()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_week':
                        $query->whereBetween('created_at', [
                            $now->copy()->subWeek()->startOfWeek()->toDateTimeString(),
                            $now->copy()->subWeek()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'last_month':
                        $query->whereBetween('created_at', [
                            $now->copy()->subMonth()->startOfMonth()->toDateTimeString(),
                            $now->copy()->subMonth()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_3_months':
                        $query->where('created_at', '>=', $now->copy()->subMonths(3)->toDateTimeString());
                        break;
                    case 'last_6_months':
                        $query->where('created_at', '>=', $now->copy()->subMonths(6)->toDateTimeString());
                        break;
                    case 'last_year':
                        $query->where('created_at', '>=', $now->copy()->subYear()->toDateTimeString());
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
            
        return view('Dashboard.DetalleEquipo.detalles_equipos', [
            'detalles_equipos' => $detallesEquipos,
            'usuarios_equipos' => usuariosEquipos::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function detalles_equipos_registrar(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string|max:255',
            'no_serie' => 'required|string|max:255|unique:detalles_equipos',
            'talla' => 'required|string|max:50',
            'piezas' => 'required|integer|min:1',
            'fecha_fabricacion' => 'required|date',
            'id_usuario_equipo' => 'required|exists:usuarios_equipos,id'
        ]);

        detallesEquipo::create([
            'modelo' => $request->modelo,
            'no_serie' => $request->no_serie,
            'talla' => $request->talla,
            'piezas' => $request->piezas,
            'fecha_fabricacion' => $request->fecha_fabricacion,
            'id_usuario_equipo' => $request->id_usuario_equipo
        ]);

        return redirect()->route('detalles_equipos')->with('success', 'Detalle de equipo registrado correctamente');
    }

    //....................................................Grupo: detalle.....
    public function detalles_equipos_detalle($id)
    {
        $query = detallesEquipo::with('usuarios_equipos')->findOrFail($id);
        return view("Dashboard.DetalleEquipo.detalles_equipos_detalle")
            ->with(['detalle_equipo' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function detalles_equipos_editar($id)
    {
        $query = detallesEquipo::with('usuarios_equipos')->findOrFail($id);
        return view("Dashboard.DetalleEquipo.detalles_equipos_editar")
            ->with([
                'detalle_equipo' => $query,
                'usuarios_equipos' => usuariosEquipos::all()
            ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function detalles_equipos_salvar(detallesEquipo $id, Request $request)
    {
        $request->validate([
            'modelo' => 'required|string|max:255',
            'no_serie' => 'required|string|max:255|unique:detalles_equipos,no_serie,'.$id->id,
            'talla' => 'required|string|max:50',
            'piezas' => 'required|integer|min:1',
            'fecha_fabricacion' => 'required|date',
            'id_usuario_equipo' => 'required|exists:usuarios_equipos,id'
        ]);

        $query = detallesEquipo::find($id->id);
        $query->modelo = $request->modelo;
        $query->no_serie = $request->no_serie;
        $query->talla = $request->talla;
        $query->piezas = $request->piezas;
        $query->fecha_fabricacion = $request->fecha_fabricacion;
        $query->id_usuario_equipo = $request->id_usuario_equipo;
        $query->save();

        return redirect()->route("detalles_equipos")->with('success', 'Detalle de equipo actualizado correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function detalles_equipos_borrar(detallesEquipo $id)
    {
        $id->delete();
        return redirect()->route('detalles_equipos')->with('success', 'Detalle de equipo eliminado correctamente');
    }
}