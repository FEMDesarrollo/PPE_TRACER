<?php

namespace App\Http\Controllers;

use App\Imports\ProveedorServicioImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\proveedorServicio;
use App\Models\proveedores;
use App\Models\servicios;
use Carbon\Carbon;

class ProveedorServiciosController extends Controller
{
    //.....................................................Proveedor_Servicios: LISTA.....
    public function proveedor_servicios(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $proveedorServicios = proveedorServicio::with(['servicio', 'proveedor'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->whereHas('servicio', function($q) use ($search) {
                            $q->where('servicio', 'like', "%$search%");
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

        $servicios = servicios::all();
        $proveedores = proveedores::all();

        return view('Dashboard.Proveedores.ProveedoresServicios.proveedorServicios', compact(
            'proveedorServicios',
            'servicios',
            'proveedores'
        ));
    }

    //.....................................................Proveedor_Servicios: REGISTRAR.....
    public function proveedor_servicios_registrar(Request $request)
    {
        $this->validate(
            $request,
            ProveedorServicio::validationRules(),
            ProveedorServicio::validationMessages()
        );

        // Verificar si ya existe esta relación
        $existente = ProveedorServicio::where('id_servicio', $request->id_servicio)
            ->where('id_proveedor', $request->id_proveedor)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Esta relación proveedor-servicio ya existe');
        }

        ProveedorServicio::create([
            'id_servicio' => $request->id_servicio,
            'id_proveedor' => $request->id_proveedor
        ]);

        return redirect()->route('proveedor_servicios')->with('success', 'Relación proveedor-servicio registrada correctamente');
    }

    //....................................................Proveedor_Servicios: DETALLE.....
    public function proveedor_servicios_detalle($id)
    {
        $proveedorServicio = ProveedorServicio::with(['servicio', 'proveedor'])->findOrFail($id);
        return view("Dashboard.Proveedores.ProveedoresServicios.proveedorServiciosDetalle", compact('proveedorServicio'));
    }

    //.....................................................Proveedor_Servicios: EDITAR.....
    public function proveedor_servicios_editar($id)
    {
        $proveedorServicio = ProveedorServicio::findOrFail($id);
        $servicios = Servicio::all();
        $proveedores = Proveedor::all();

        return view("Dashboard.Proveedores.ProveedoresServicios.proveedorServiciosEditar", compact(
            'proveedorServicio',
            'servicios',
            'proveedores'
        ));
    }

    //.....................................................Proveedor_Servicios: SALVAR.....
    public function proveedor_servicios_salvar(Request $request, $id)
    {
        $this->validate(
            $request,
            ProveedorServicio::validationRules(),
            ProveedorServicio::validationMessages()
        );

        $proveedorServicio = ProveedorServicio::findOrFail($id);

        // Verificar si ya existe esta relación (excluyendo el actual)
        $existente = ProveedorServicio::where('id_servicio', $request->id_servicio)
            ->where('id_proveedor', $request->id_proveedor)
            ->where('id', '!=', $id)
            ->first();

        if ($existente) {
            return redirect()->back()->with('error', 'Esta relación proveedor-servicio ya existe');
        }

        $proveedorServicio->update([
            'id_servicio' => $request->id_servicio,
            'id_proveedor' => $request->id_proveedor
        ]);

        return redirect()->route("proveedor_servicios")->with('success', 'Relación proveedor-servicio actualizada correctamente');
    }

    //.....................................................Proveedor_Servicios: BORRAR.....
    public function proveedor_servicios_borrar($id)
    {
        $proveedorServicio = ProveedorServicio::findOrFail($id);
        $proveedorServicio->delete();

        return redirect()->route('proveedor_servicios')->with('success', 'Relación proveedor-servicio eliminada correctamente');
    }

    //..................................................Subestación: Importar.....
    public function proveedor_servicios_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
        Excel::import(new ProveedorServicioImport, $request->file('archivo_excel'));
            return redirect()->route('proveedor_servicios')->with('success', 'Proveedores servicios importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('proveedor_servicios')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('proveedor_servicios')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}
