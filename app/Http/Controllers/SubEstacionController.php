<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Estaciones;
use App\Models\SubEstacion;
use Carbon\Carbon;
use App\Imports\SubestacionImport;
use Maatwebsite\Excel\Facades\Excel;

class SubEstacionController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function subestaciones(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $subestaciones = SubEstacion::with('estacion')
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('id_estacion', $search);
                } else {
                    $query->where('nombre', 'like', "%$search%")
                          ->orWhere('direccion', 'like', "%$search%");
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
            
        return view('Dashboard.SubEstacion.subestaciones', [
            'subestaciones' => $subestaciones,
            'estaciones' => Estaciones::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function subestaciones_registrar(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'id_estacion' => 'required|exists:estaciones,id'
        ]);

        SubEstacion::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'id_estacion' => $request->id_estacion
        ]);

        return redirect()->route('subestaciones')->with('success', 'Subestación registrada correctamente');
    }

    //....................................................Grupo: detalle.....
    public function subestaciones_detalle($id)
    {
        $query = SubEstacion::with('estacion')->findOrFail($id);
        return view("Dashboard.SubEstacion.subestaciones_detalle")
            ->with(['subestacion' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function subestaciones_editar($id)
    {
        $query = SubEstacion::with('estacion')->findOrFail($id);
        return view("Dashboard.SubEstacion.subestaciones_editar", [
            'subestacion' => $query,
            'estaciones' => Estaciones::all()
        ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function subestaciones_salvar(SubEstacion $id, Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'id_estacion' => 'required|exists:estaciones,id'
        ]);

        $query = SubEstacion::find($id->id);
        $query->nombre = $request->nombre;
        $query->direccion = $request->direccion;
        $query->telefono = $request->telefono;
        $query->id_estacion = $request->id_estacion;
        $query->save();

        return redirect()->route("subestaciones")->with('success', 'Subestación actualizada correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function subestaciones_borrar(SubEstacion $id)
    {
        $id->delete();
        return redirect()->route('subestaciones')->with('success', 'Subestación eliminada correctamente');
    }
                //..................................................Grupo: Importar.....
        public function Subestacion_importar(Request $request)
        {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new SubestacionImport, $request->file('archivo_excel'));

        return redirect()->route('subestaciones')->with('success', 'subestaciones importados correctamente.');
        }
}