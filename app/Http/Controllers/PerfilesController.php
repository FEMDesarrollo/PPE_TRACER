<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Perfiles;
use Carbon\Carbon;
use App\Imports\PerfilesImport;
use Maatwebsite\Excel\Facades\Excel;

class PerfilesController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function perfiles(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $perfiles = Perfiles::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('nombre', 'like', "%$search%");
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
            
        return view('Dashboard.Perfiles.perfiles', compact('perfiles'));
    }

    //.....................................................Grupos: REGISTRAR.....
    public function perfiles_registrar(Request $request)
    {
        $this->validate($request, 
        Perfiles::validationRules(),
        Perfiles::validationMessages()
    );

        Perfiles::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('perfiles')->with('success', 'Perfil registrado correctamente');
    }

    //....................................................Grupo: detalle.....
    public function perfiles_detalle($id)
    {
        $query = Perfiles::find($id);
        return view("Dashboard.Perfiles.perfiles")
            ->with(['perfiles' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function perfiles_editar($id)
    {
        $query = Perfiles::find($id);
        return view("Dashboard.Perfiles.perfiles_editar")
            ->with(['perfiles' => $query]);
    }

    //.....................................................Grupos: SALVAR.....
    public function perfiles_salvar(Perfiles $id, Request $request)
    {
        $this->validate($request, 
        Perfiles::validationRules(),
        Perfiles::validationMessages()
    );

        $query = Perfiles::find($id->id);
        $query->nombre = $request->nombre;
        $query->save();

        return redirect()->route("perfiles")->with('success', 'Perfil actualizado correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function perfiles_borrar(Perfiles $id)
    {
        $id->delete();
        return redirect()->route('perfiles')->with('success', 'Perfil eliminado correctamente');
    }
    //..................................................Grupo: Importar.....
public function perfiles_importar(Request $request)
{
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        Excel::import(new PerfilesImport, $request->file('archivo_excel'));
        return redirect()->route('perfiles')->with('success', 'Perfiles importados correctamente.');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $e->failures();

        $errorMessages = [];
        foreach ($failures as $failure) {
            $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
        }

        return redirect()->route('perfiles')
            ->with('error', 'Error en la importación:')
            ->with('errorDetails', $errorMessages);
    } catch (\Exception $e) {
        return redirect()->route('perfiles')
            ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
    }
  }

}

