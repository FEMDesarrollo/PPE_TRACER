<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\EstatusEquipos;
use Carbon\Carbon;
use App\Imports\EstatusEquiposImport;
use Maatwebsite\Excel\Facades\Excel;

class EstatusEquiposController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function estatus_equipos(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $estatusEquipos = EstatusEquipos::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('estado', 'like', "%$search%");
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
                        $query->whereBetween('createdated_at', [
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

        return view('Dashboard.EstatusEquipo.estatus_equipos', compact('estatusEquipos'));
    }

    //.....................................................Grupos: REGISTRAR.....
    public function estatus_equipos_registrar(Request $request)
    {
        $this->validate($request, 
        EstatusEquipos::validationRules(),
        EstatusEquipos::validationMessages() 
    );

        EstatusEquipos::create([
            'estado' => $request->estado
        ]);

        return redirect()->route('estatus_equipos')->with('success', 'Estado de equipo registrado correctamente');
    }

    //....................................................Grupo: detalle.....
    public function estatus_equipos_detalle($id)
    {
        $query = EstatusEquipos::find($id);
        return view("Dashboard.EstatusEquipo.estatus_equipos")
            ->with(['estatusEquipos' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function estatus_equipos_editar($id)
    {
        $query = EstatusEquipos::find($id);
        return view("Dashboard.EstatusEquipo.estatus_equipos_editar")
            ->with(['estatusEquipos' => $query]);
    }

    //.....................................................Grupos: SALVAR.....
    public function estatus_equipos_salvar(EstatusEquipos $id, Request $request)
    {
        $this->validate($request, 
    EstatusEquipos::validationRules(),
    EstatusEquipos::validationMessages() 
    );

        $query = EstatusEquipos::find($id->id);
        $query->estado = $request->estado;
        $query->save();

        return redirect()->route("estatus_equipos")->with('success', 'Estado de equipo actualizado correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function estatus_equipos_borrar(EstatusEquipos $id)
    {
        $id->delete();
        return redirect()->route('estatus_equipos')->with('success', 'Estado de equipo eliminado correctamente');
    }


//..................................................Grupo: Importar.....
public function estatus_equipos_importar(Request $request)
{
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        Excel::import(new EstatusEquiposImport, $request->file('archivo_excel'));
        return redirect()->route('estatus_equipos')->with('success', 'Estatus de equipo importadas correctamente.');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();

        $errorMessages = [];
        foreach ($failures as $failure) {
            $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
        }

        return redirect()->route('estatus_equipos')
            ->with('error', 'Error en la importación:')
            ->with('errorDetails', $errorMessages);
    } catch (\Exception $e) {
        return redirect()->route('estatus_equipos')
            ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
    }
  }

}
