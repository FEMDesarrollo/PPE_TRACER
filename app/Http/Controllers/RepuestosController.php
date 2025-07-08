<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accesorios;
use App\Models\proveedorServicio;
use App\Models\repuestos;
use Carbon\Carbon;

class RepuestosController extends Controller
{
    //.....................................................Repuestos: LISTA.....
    public function repuestos(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        $costFilter = $request->input('cost_filter');
        
        $repuestos = repuestos::with(['accesorio', 'prov_servicio'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('costo', 'like', "%$search%");
                          
                } else {
                    $query->where('costo', 'like', "%$search%")
                          ->orWhereHas('accesorio', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
                          });
                }
            })
            ->when($timeFilter, function($query) use ($timeFilter) {
                $now = Carbon::now();
                
                switch ($timeFilter) {
                    case 'today':
                        $query->whereDate('fecha_disponible', $now->toDateString());
                        break;
                    case 'this_week':
                        $query->whereBetween('fecha_disponible', [
                            $now->copy()->startOfWeek()->toDateTimeString(),
                            $now->copy()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'this_month':
                        $query->whereBetween('fecha_disponible', [
                            $now->copy()->startOfMonth()->toDateTimeString(),
                            $now->copy()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_week':
                        $query->whereBetween('fecha_disponible', [
                            $now->copy()->subWeek()->startOfWeek()->toDateTimeString(),
                            $now->copy()->subWeek()->endOfWeek()->toDateTimeString()
                        ]);
                        break;
                    case 'last_month':
                        $query->whereBetween('fecha_disponible', [
                            $now->copy()->subMonth()->startOfMonth()->toDateTimeString(),
                            $now->copy()->subMonth()->endOfMonth()->toDateTimeString()
                        ]);
                        break;
                    case 'last_3_months':
                        $query->where('fecha_disponible', '>=', $now->copy()->subMonths(3)->toDateTimeString());
                        break;
                    case 'last_6_months':
                        $query->where('fecha_disponible', '>=', $now->copy()->subMonths(6)->toDateTimeString());
                        break;
                    case 'last_year':
                        $query->where('fecha_disponible', '>=', $now->copy()->subYear()->toDateTimeString());
                        break;
                }
            })
            ->when($costFilter, function($query) use ($costFilter) {
                switch ($costFilter) {
                    case '0-100':
                        $query->whereBetween('costo', [0, 100]);
                        break;
                    case '100-500':
                        $query->whereBetween('costo', [100, 500]);
                        break;
                    case '500-1000':
                        $query->whereBetween('costo', [500, 1000]);
                        break;
                    case '1000+':
                        $query->where('costo', '>', 1000);
                        break;
                }
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'time_filter' => $timeFilter,
                'cost_filter' => $costFilter
            ]);
            
        return view('Dashboard.Repuestos.repuestos', [
            'repuestos' => $repuestos,
            'accesorios' => accesorios::all(),
            'proveedorServicios' => proveedorServicio::all()
        ]);
    }

    //.....................................................Repuestos: REGISTRAR.....
    public function repuestos_registrar(Request $request){
        repuestos::create(array(
            'costo' => $request->input('costo'),
            'fecha_disponible' => $request->input('fecha_disponible'),
            'id_prov_servicio' => $request->input('id_prov_servicio'),
            'id_accesorio' => $request->input('id_accesorio')

        ));

        return redirect()->route('repuestos');
    }

    //....................................................Repuestos: DETALLE.....
    public function repuestos_detalle($id)
    {
        $query = repuestos::with(['accesorio', 'proveedorServicio'])->findOrFail($id);
        return view("Dashboard.Repuestos.repuestos_detalle")
            ->with(['repuesto' => $query]);
    }

    //.....................................................Repuestos: EDITAR.....
    public function repuestos_editar($id)
    {
        $query = repuestos::with(['accesorio', 'proveedorServicio'])->findOrFail($id);
        return view("Dashboard.Repuestos.repuestos_editar")
            ->with([
                'repuesto' => $query,
                'accesorios' => accesorios::all(),
                'proveedorServicios' => proveedorServicio::all()
            ]);
    }

    //.....................................................Repuestos: SALVAR.....
    public function repuestos_salvar(repuestos $id, Request $request)
    {
        $request->validate([
            'costo' => 'required|numeric|min:0',
            'fecha_disponible' => 'required|date',
            'id_prov_servicio' => 'required|exists:proveedor_servicios,id',
            'id_accesorio' => 'required|exists:accesorios,id'
        ]);

        $query = repuestos::find($id->id);
        $query->costo = $request->costo;
        $query->fecha_disponible = $request->fecha_disponible;
        $query->id_prov_servicio = $request->id_prov_servicio;
        $query->id_accesorio = $request->id_accesorio;
        $query->save();

        return redirect()->route("repuestos")->with('success', 'Repuesto actualizado correctamente');
    }

    //.....................................................Repuestos: BORRAR.....
    public function repuestos_borrar(repuestos $id)
    {
        $id->delete();
        return redirect()->route('repuestos')->with('success', 'Repuesto eliminado correctamente');
    }
}