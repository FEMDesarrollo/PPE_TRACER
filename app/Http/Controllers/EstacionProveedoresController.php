<?php

namespace App\Http\Controllers;

use App\Imports\EstacionProveedoresImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Proveedores;
use App\Models\Estaciones;
use App\Models\EstacionProveedores;
use Carbon\Carbon;

class EstacionProveedoresController extends Controller
{
    //.....................................................Estación proveedores: LISTA.....
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

    //.....................................................Estación proveedores: REGISTRAR.....
    public function estacion_proveedores_registrar(Request $request)
    {
        $this->validate(
            $request,
            EstacionProveedores::validationRules(),
            EstacionProveedores::validationMessages()
        );

        EstacionProveedores::create([
            'id_proveedor' => $request->id_proveedor,
            'id_estacion' => $request->id_estacion
        ]);

        return redirect()->route('estacion_proveedores')->with('success', 'Relación estación-proveedor registrada correctamente');
    }

    //....................................................Estación proveedores: DETALLE.....
    public function estacion_proveedores_detalle($id)
    {
        $query = EstacionProveedores::with('estacion', 'proveedor')->findOrFail($id);
        return view("Dashboard.EstacionProveedores.estacion_proveedores_detalle")
            ->with(['estacion_proveedor' => $query]);
    }

    //.....................................................Estación proveedores: EDITAR.....
    public function estacion_proveedores_editar($id)
    {
        $query = EstacionProveedores::with('estacion', 'proveedor')->findOrFail($id);
        return view("Dashboard.EstacionProveedores.estacion_proveedores_editar", [
            'estacion_proveedor' => $query,
            'proveedores' => Proveedores::all(),
            'estaciones' => Estaciones::all()
        ]);
    }

    //.....................................................Estación proveedores: SALVAR.....
    public function estacion_proveedores_salvar(EstacionProveedores $id, Request $request)
    {
         $this->validate(
            $request,
            EstacionProveedores::validationRules(),
            EstacionProveedores::validationMessages()
        );

        $query = EstacionProveedores::find($id->id);
        $query->id_proveedor = $request->id_proveedor;
        $query->id_estacion = $request->id_estacion;
        $query->save();

        return redirect()->route("estacion_proveedores")->with('success', 'Relación estación-proveedor actualizada correctamente');
    }

    //..................................................Estación proveedores: BORRAR.....
    public function estacion_proveedores_borrar(EstacionProveedores $id)
    {
        $id->delete();
        return redirect()->route('estacion_proveedores')->with('success', 'Relación estación-proveedor eliminada correctamente');
    }

    //.....................................................Accesorios: Importar.....
    public function estacion_proveedores_importar(Request $request)
    {
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        Excel::import(new EstacionProveedoresImport, $request->file('archivo_excel'));
            return redirect()->route('estacion_proveedores')->with('success', 'Estaciones de proveedores importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('estacion_proveedores')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('estacion_proveedores')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}
