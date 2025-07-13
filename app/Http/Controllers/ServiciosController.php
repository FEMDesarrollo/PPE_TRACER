<?php

namespace App\Http\Controllers;

use App\Imports\ServiciosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\servicios;
use Carbon\Carbon;

class ServiciosController extends Controller
{
    //.....................................................Servicios: LISTA.....
    public function servicios(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $servicios = servicios::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('servicio', 'like', "%$search%");
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
            
        return view('Dashboard.Servicios.servicios', compact('servicios'));
    }

    //.....................................................Servicios: REGISTRAR.....
    public function servicio_registrar(Request $request)
    {
        $this->validate(
            $request,
            servicios::validationRules(),
            servicios::validationMessages()
        );

        servicios::create([
            'servicio' => $request->servicio
        ]);

        return redirect()->route('servicios')->with('success', 'Servicio registrado correctamente');
    }

    //....................................................Servicios: DETALLE.....
    public function servicio_detalle($id)
    {
        $query = servicios::find($id);
        return view("Dashboard.Servicios.servicios")
            ->with(['servicios' => $query]);
    }

    //....................................................Servicios: EDITAR.....
    public function servicio_editar($id)
    {
        $query = servicios::find($id);
        return view("Dashboard.Servicios.servicio_editar")
            ->with(['servicio' => $query]);
    }

    //.....................................................Servicios: SALVAR.....
    public function servicio_salvar(servicios $id, Request $request)
    {
        $this->validate(
            $request,
            servicios::validationRules(),
            servicios::validationMessages()
        );

        $query = servicios::find($id->id);
        $query->servicio = $request->servicio;
        $query->save();

        return redirect()->route("servicios")->with('success', 'Servicio actualizado correctamente');
    }

    //..................................................Servicios: Borrar.....
    public function servicio_borrar(servicios $id)
    {
        $id->delete();
        return redirect()->route('servicios')->with('success', 'Servicio eliminado correctamente');
    }


    //..................................................Servicios: Importar.....
    public function servicios_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        
    try {
        Excel::import(new ServiciosImport, $request->file('archivo_excel'));
            return redirect()->route('servicios')->with('success', 'Servicios importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('servicios')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('servicios')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}

