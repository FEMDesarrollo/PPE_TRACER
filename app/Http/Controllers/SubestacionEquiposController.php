<?php

namespace App\Http\Controllers;

use App\Imports\SubestacionEquiposImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\subestacionEquipos;
use App\Models\equipos;
use App\Models\estaciones;
use App\Models\subEstacion;
use Carbon\Carbon;

class SubEstacionEquiposController extends Controller
{
    //.....................................................Subestación Equipos: LISTA.....
    public function subestacion_equipos(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        $estacionFilter = $request->input('estacion_filter');
        $subestacionFilter = $request->input('subestacion_filter');

        $subestacionEquipos = subestacionEquipos::with(['equipo', 'estacion', 'subEstacion'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('no_traje', $search);
                } else {
                    $query->where('no_traje', 'like', "%$search%")
                          ->orWhereHas('equipo', function($q) use ($search) {
                              $q->where('equipo', 'like', "%$search%");
                          })
                          ->orWhereHas('estacion', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
                          })
                          ->orWhereHas('subEstacion', function($q) use ($search) {
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
                }
            })
            ->when($estacionFilter, function($query) use ($estacionFilter) {
                $query->where('id_estacion', $estacionFilter);
            })
            ->when($subestacionFilter, function($query) use ($subestacionFilter) {
                $query->where('id_subestacion', $subestacionFilter);
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'time_filter' => $timeFilter,
                'estacion_filter' => $estacionFilter,
                'subestacion_filter' => $subestacionFilter
            ]);

        return view('Dashboard.SubestacionEquipos.subestacionEquipos', [
            'subestacionEquipos' => $subestacionEquipos,
            'equipos' => equipos::all(),
            'estaciones' => estaciones::all(),
            'subEstacion' => subEstacion::all()
        ]);
    }

    //.....................................................Subestación Equipos: REGISTRAR.....

    public function subestacion_equipos_registrar(Request $request)
    {
        $this->validate(
            $request,
            subestacionEquipos::validationRules(),
            subestacionEquipos::validationMessages()
        );

        subestacionEquipos::create(array(
            'no_traje' => $request->input('no_traje'),
            'id_equipo' => $request->input('id_equipo'),
            'id_estacion' => $request->input('id_estacion'),
            'id_subestacion' => $request->input('id_subestacion')

        ));

        return redirect()->route('subestacion_equipos');
    }

    //....................................................Subestación Equipos: DETALLE.....
    public function subestacion_equipos_detalle($id){
            $query = subestacionEquipos::find($id);
            return view("Dashboard.SubestacionEquipos.subestacionEquipos")
                ->with(['subestacionEquipos' => $query]);
    }

    //.....................................................Subestación Equipos: EDITAR.....


    public function subestacion_equipos_editar($id){
                $query = subestacionEquipos::find($id);
                return view("Dashboard.SubestacionEquipos.subestacionEquipos")
                    ->with(['subestacionEquipos' => $query]);
    }


    //.....................................................Subestación Equipos: SALVAR.....

    public function subestacion_equipos_salvar(subestacionEquipos $id, Request $request)
    {
         $this->validate(
            $request,
            subestacionEquipos::validationRules(),
            subestacionEquipos::validationMessages()
        );

        //dd($request->all());
        $query = subestacionEquipos::find($id->id);
            $query -> no_traje = $request -> no_traje;
            $query -> id_equipo = $request -> id_equipo;
            $query -> id_estacion = $request -> id_estacion;
            $query -> id_subestacion = $request -> id_subestacion;
        $query -> save();

        return redirect()->route("subestacion_equipos", ['id' => $id->id]);
        }

    //.....................................................Subestación Equipos: BORRAR.....
        public function subestacion_equipos_borrar (subestacionEquipos $id){
            $id->delete();
            return redirect()->route('subestacion_equipos');
            }
 //..................................................SubestaciónEquipos: Importar.....
    public function subestacion_equipos_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
        Excel::import(new SubestacionEquiposImport, $request->file('archivo_excel'));
            return redirect()->route('subestacion_equipos')->with('success', 'Subestaciones equipos importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('subestacion_equipos')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('subestacion_equipos')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}
