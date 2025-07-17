<?php

namespace App\Http\Controllers;

use App\Imports\PermisosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Permisos;
use Carbon\Carbon;

class PermisosController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function permisos(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $permisos = Permisos::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where(function($q) use ($search) {
                        $q->where('permiso', 'like', "%$search%")
                          ->orWhere('url', 'like', "%$search%");
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

        return view('Dashboard.Permiso.permisos', compact('permisos'));
    }

    //.....................................................Grupos: REGISTRAR.....
    public function permisos_registrar(Request $request)
    {
        $this->validate(
            $request,
            Permisos::validationRules(),
            Permisos::validationMessages()
        );

        Permisos::create([
            'permiso' => $request->permiso,
            'url' => $request->url
        ]);

        return redirect()->route('permisos')->with('success', 'Permiso registrado correctamente');
    }

    //....................................................Grupo: detalle.....
    public function permisos_detalle($id)
    {
        $query = Permisos::find($id);
        return view("Dashboard.Permiso.permisos")
            ->with(['permisos' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function permisos_editar($id)
    {
        $query = Permisos::find($id);
        return view("Dashboard.Permiso.permisos_editar")
            ->with(['permisos' => $query]);
    }

    //.....................................................Grupos: SALVAR.....
    public function permisos_salvar(Permisos $id, Request $request)
    {
        $this->validate(
            $request,
            Permisos::validationRules(),
            Permisos::validationMessages()
        );

        $query = Permisos::find($id->id);
        $query->permiso = $request->permiso;
        $query->url = $request->url;
        $query->save();

        return redirect()->route("permisos")->with('success', 'Permiso actualizado correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function permisos_borrar(Permisos $id)
    {
        $id->delete();
        return redirect()->route('permisos')->with('success', 'Permiso eliminado correctamente');
    }

    //..................................................Subestación: Importar.....
    public function permisos_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
        Excel::import(new PermisosImport, $request->file('archivo_excel'));
            return redirect()->route('permisos')->with('success', 'Permisos importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('permisos')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('permisos')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}
