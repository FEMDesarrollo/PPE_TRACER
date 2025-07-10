<?php

namespace App\Http\Controllers;

use App\Imports\EquiposImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Equipos;
use Carbon\Carbon;

class EquiposController extends Controller
{
    //.....................................................Equipo: LISTA.....
    public function equipos(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $equipos = Equipos::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('equipo', 'like', "%$search%");
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
            
        return view('Dashboard.Equipos.equipos', compact('equipos'));
    }

    //.....................................................Equipo: REGISTRAR.....
    public function equipos_registrar(Request $request)
    {
        $this->validate($request, [
            'equipo' => 'required'
        ]);

        Equipos::create([
            'equipo' => $request->equipo
        ]);

        return redirect()->route('equipos')->with('success', 'Equipo registrado correctamente');
    }

    //....................................................Equipo: detalle.....
    public function equipos_detalle($id)
    {
        $query = Equipos::find($id);
        return view("Dashboard.Equipos.equipos")
            ->with(['equipos' => $query]);
    }

    //.....................................................Equipo: EDITAR.....
    public function equipos_editar($id)
    {
        $query = Equipos::find($id);
        return view("Dashboard.Equipos.equipos_editar")
            ->with(['equipos' => $query]);
    }

    //.....................................................Equipo: SALVAR.....
    public function equipos_salvar(Equipos $id, Request $request)
    {
        $this->validate($request, [
            'equipo' => 'required'
        ]);

        $query = Equipos::find($id->id);
        $query->equipo = $request->equipo;
        $query->save();

        return redirect()->route("equipos")->with('success', 'Equipo actualizado correctamente');
    }

    //..................................................Equipo: Borrar.....
    public function equipos_borrar(Equipos $id)
    {
        $id->delete();
        return redirect()->route('equipos')->with('success', 'Equipo eliminado correctamente');
    }

    //..................................................Servicios: Importar.....
    public function equipos_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new EquiposImport, $request->file('archivo_excel'));

        return redirect()->route('equipos')->with('success', 'Equipos importados correctamente.');
    }
}