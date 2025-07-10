<?php

namespace App\Http\Controllers;

use App\Imports\EstatusCriticoImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\EstatusCritico;
use Carbon\Carbon;

class EstatusCriticoController extends Controller
{
   //.....................................................Estatus critico: LISTA.....
public function estatus_critico(Request $request)
{
    $perPage = $request->input('per_page', 5);
    $search = $request->input('search');
    $timeFilter = $request->input('time_filter');
    
    $estatusCritico = EstatusCritico::query()
        ->when($search, function($query) use ($search) {
            if (is_numeric($search) && ctype_digit($search)) {
                $query->where('id', $search);
            } else {
                $query->where('estatus', 'like', "%$search%");
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
        
    return view('Dashboard.EstatusCritico.estatus_critico', compact('estatusCritico'));
}

    //.....................................................Estatus critico: REGISTRAR.....
    public function estatus_critico_registrar(Request $request)
    {
        $this->validate($request, [
            'estatus' => 'required'
        ]);

        EstatusCritico::create([
            'estatus' => $request->estatus
        ]);

        return redirect()->route('estatus_critico')->with('success', 'Estatus crítico registrado correctamente');
    }

    //....................................................Estatus critico: detalle.....
    public function estatus_critico_detalle($id)
    {
        $query = EstatusCritico::find($id);
        return view("Dashboard.EstatusCritico.estatus_critico")
            ->with(['estatus_critico' => $query]);
    }

    //.....................................................Estatus critico: EDITAR.....
    public function estatus_critico_editar($id)
    {
        $query = EstatusCritico::find($id);
        return view("Dashboard.EstatusCritico.estatus_critico_editar")
            ->with(['estatus_critico' => $query]);
    }

    //.....................................................Estatus critico: SALVAR.....
    public function estatus_critico_salvar(EstatusCritico $id, Request $request)
    {
        $this->validate($request, [
            'estatus' => 'required'
        ]);

        $query = EstatusCritico::find($id->id);
        $query->estatus = $request->estatus;
        $query->save();

        return redirect()->route("estatus_critico")->with('success', 'Estatus crítico actualizado correctamente');
    }

    //..................................................Estatus critico: BORRAR.....
    public function estatus_critico_borrar(EstatusCritico $id)
    {
        $id->delete();
        return redirect()->route('estatus_critico')->with('success', 'Estatus crítico eliminado correctamente');
    }

    //..................................................Servicios: Importar.....
    public function estatus_critico_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new EstatusCriticoImport, $request->file('archivo_excel'));

        return redirect()->route('estatus_critico')->with('success', 'Estatus críticos importados correctamente.');
    }
}