<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Proveedores;
use App\Models\Estaciones;
use App\Models\EstacionProveedores;
use Carbon\Carbon;

class EstacionProveedoresController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function estacion_proveedores(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $estacionProveedores = EstacionProveedores::with('estacion', 'proveedor')
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('id_proveedor', $search)
                          ->orWhere('id_estacion', $search);
                } else {
                    $query->whereHas('estacion', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
                          })
                          ->orWhereHas('proveedor', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
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

        return view('Dashboard.EstacionProveedores.estacion_proveedores', [
            'estacion_proveedores' => $estacionProveedores,
            'proveedores' => Proveedores::all(),
            'estaciones' => Estaciones::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function estacion_proveedores_registrar(Request $request)
    {
        $this->validate($request, [
        'id_proveedor' => 'required',
        'id_estacion' => 'required'
        ], [
            'id_proveedor.required' => 'Debes seleccionar un proveedor.',

            'id_estacion.required' => 'Debes seleccionar una estacion.',
        ]);

        EstacionProveedores::create([
            'id_proveedor' => $request->id_proveedor,
            'id_estacion' => $request->id_estacion
        ]);

        return redirect()->route('estacion_proveedores')->with('success', 'Relación estación-proveedor registrada correctamente');
    }

    //....................................................Grupo: detalle.....
    public function estacion_proveedores_detalle($id)
    {
        $query = EstacionProveedores::with('estacion', 'proveedor')->findOrFail($id);
        return view("Dashboard.EstacionProveedores.estacion_proveedores_detalle")
            ->with(['estacion_proveedor' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function estacion_proveedores_editar($id)
    {
        $query = EstacionProveedores::with('estacion', 'proveedor')->findOrFail($id);
        return view("Dashboard.EstacionProveedores.estacion_proveedores_editar", [
            'estacion_proveedor' => $query,
            'proveedores' => Proveedores::all(),
            'estaciones' => Estaciones::all()
        ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function estacion_proveedores_salvar(EstacionProveedores $id, Request $request)
    {
        $this->validate($request, [
        'id_proveedor' => 'required',
        'id_estacion' => 'required'
        ], [
            'id_proveedor.required' => 'Debes seleccionar un proveedor.',

            'id_estacion.required' => 'Debes seleccionar una estacion.',
        ]);

        $query = EstacionProveedores::find($id->id);
        $query->id_proveedor = $request->id_proveedor;
        $query->id_estacion = $request->id_estacion;
        $query->save();

        return redirect()->route("estacion_proveedores")->with('success', 'Relación estación-proveedor actualizada correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function estacion_proveedores_borrar(EstacionProveedores $id)
    {
        $id->delete();
        return redirect()->route('estacion_proveedores')->with('success', 'Relación estación-proveedor eliminada correctamente');
    }
}
