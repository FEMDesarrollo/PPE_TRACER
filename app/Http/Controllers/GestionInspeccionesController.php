<?php

namespace App\Http\Controllers;

use App\Imports\GestionInspeccionesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\gestionInspecciones;
use Carbon\Carbon;

class GestionInspeccionesController extends Controller
{
    //.....................................................Gestión de inspecciones: Lista.....
    public function gestion_inspecciones(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $gestion_inspecciones = gestionInspecciones::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('observaciones', 'like', "%$search%");
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

        return view('Dashboard.GestionInspeccion.gestion_inspecciones', compact('gestion_inspecciones'));
    }

    //.....................................................Gestión de inspecciones: REGISTRAR.....
    public function gestion_inspecciones_registrar(Request $request)
    {
        $this->validate($request, 
        gestionInspecciones::validationRules(),
        gestionInspecciones::validationMessages() 
    );

        gestionInspecciones::create([
            'observaciones' => $request->observaciones
        ]);

        return redirect()->route('gestion_inspecciones')->with('success', 'Inspección registrada correctamente');
    }

    //....................................................Gestión de inspecciones: detalle.....
    public function gestion_inspecciones_detalle($id)
    {
        $query = gestionInspecciones::find($id);
        return view('Dashboard.GestionInspeccion.gestion_inspecciones')->with([
            'gestion_inspecciones' => $query
        ]);
    }

    //.....................................................Gestión de inspecciones: EDITAR.....
    public function gestion_inspecciones_editar($id)
    {
        $query = gestionInspecciones::find($id);
        return view('Dashboard.GestionInspeccion.gestion_inspecciones_editar')->with([
            'gestion_inspecciones' => $query
        ]);
    }

    //.....................................................Gestión de inspecciones: SALVAR.....
    public function gestion_inspecciones_salvar(gestionInspecciones $id, Request $request)
    {
        $this->validate($request, 
        gestionInspecciones::validationRules(),
        gestionInspecciones::validationMessages() 
    );

        $query = gestionInspecciones::find($id->id);
        $query->observaciones = $request->observaciones;
        $query->save();

        return redirect()->route('gestion_inspecciones')->with('success', 'Inspección actualizada correctamente');
    }

    //..................................................Gestión de inspecciones: BORRAR.....
    public function gestion_inspecciones_borrar(gestionInspecciones $id)
    {
        $id->delete();
        return redirect()->route('gestion_inspecciones')->with('success', 'Inspección eliminada correctamente');
    }

    //..................................................Grupo: Importar.....
public function gestion_inspecciones_importar(Request $request)
{
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        Excel::import(new GestionInspeccionesImport, $request->file('archivo_excel'));
        return redirect()->route('gestion_inspecciones')->with('success', 'Inspecciones importadas correctamente.');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();

        $errorMessages = [];
        foreach ($failures as $failure) {
            $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
        }

        return redirect()->route('gestion_inspecciones')
            ->with('error', 'Error en la importación:')
            ->with('errorDetails', $errorMessages);
    } catch (\Exception $e) {
        return redirect()->route('gestion_inspecciones')
            ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
    }
  }

}



