<?php

namespace App\Http\Controllers;

use App\Imports\VerificacionCorreoImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\verificacionCorreo;
use App\Models\usuarios;
use Carbon\Carbon;

class VerificacionCorreoController extends Controller
{
    //.....................................................Verificación Correo: LISTA.....
    public function verificacion_correo(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        $usuarioFilter = $request->input('usuario_filter');
        $dateFilter = $request->input('date_filter');
        
        $verificaciones = verificacionCorreo::with(['usuarios'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('codigo_verificacion', $search)
                          ->orWhere('id_usuario', $search);
                } else {
                    $query->where('codigo_verificacion', 'like', "%$search%")
                          ->orWhereHas('usuarios', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");                          });
                }
            })
            ->when($timeFilter, function($query) use ($timeFilter) {
                $now = Carbon::now();
                
                switch ($timeFilter) {
                    case 'today':
                        $query->whereDate('fecha', $now->toDateString());
                        break;
                    case 'this_week':
                        $query->whereBetween('fecha', [
                            $now->copy()->startOfWeek()->toDateString(),
                            $now->copy()->endOfWeek()->toDateString()
                        ]);
                        break;
                    case 'this_month':
                        $query->whereBetween('fecha', [
                            $now->copy()->startOfMonth()->toDateString(),
                            $now->copy()->endOfMonth()->toDateString()
                        ]);
                        break;
                    case 'last_week':
                        $query->whereBetween('fecha', [
                            $now->copy()->subWeek()->startOfWeek()->toDateString(),
                            $now->copy()->subWeek()->endOfWeek()->toDateString()
                        ]);
                        break;
                    case 'last_month':
                        $query->whereBetween('fecha', [
                            $now->copy()->subMonth()->startOfMonth()->toDateString(),
                            $now->copy()->subMonth()->endOfMonth()->toDateString()
                        ]);
                        break;
                }
            })
            ->when($dateFilter, function($query) use ($dateFilter) {
                $query->whereDate('fecha', $dateFilter);
            })
            ->when($usuarioFilter, function($query) use ($usuarioFilter) {
                $query->where('id_usuario', $usuarioFilter);
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'time_filter' => $timeFilter,
                'usuario_filter' => $usuarioFilter,
                'date_filter' => $dateFilter
            ]);
            
        return view('Dashboard.VerificacionesCorreos.verificacion_correo', [
            'verificacion_correo' => $verificaciones,
            'usuarios' => usuarios::all()
        ]);
    }

    //.....................................................Verificación Correo: REGISTRAR.....
    public function verificacion_correo_registrar(Request $request)
    {
        $this->validate(
            $request,
            verificacionCorreo::validationRules(),
            verificacionCorreo::validationMessages()
        );

        return redirect()->route('verificacion_correo')->with('success', 'Verificación de correo registrada correctamente');
    }

    //....................................................Verificación Correo: DETALLE.....
    public function verificacion_correo_detalle($id)
    {
        $query = verificacionCorreo::with(['usuario'])->findOrFail($id);
        return view("Dashboard.VerificacionesCorreos.verificacion_correo_detalle")
            ->with(['verificacion' => $query]);
    }

    //.....................................................Verificación Correo: EDITAR.....
    public function verificacion_correo_editar($id)
    {
        $query = verificacionCorreo::with(['usuario'])->findOrFail($id);
        return view("Dashboard.VerificacionesCorreos.verificacion_correo_editar")
            ->with([
                'verificacion' => $query,
                'usuarios' => usuarios::all()
            ]);
    }

    //.....................................................Verificación Correo: SALVAR.....
    public function verificacion_correo_salvar(verificacionCorreo $id, Request $request)
    {
       
        $this->validate(
            $request,
            verificacionCorreo::validationRules(),
            verificacionCorreo::validationMessages()
        );

        $query = verificacionCorreo::find($id->id);
        $query->codigo_verificacion = $request->codigo_verificacion;
        $query->fecha = $request->fecha;
        $query->id_usuario = $request->id_usuario;
        $query->save();

        return redirect()->route("verificacion_correo")->with('success', 'Verificación de correo actualizada correctamente');
    }

    //.....................................................Verificación Correo: BORRAR.....
    public function verificacion_correo_borrar(verificacionCorreo $id)
    {
        $id->delete();
        return redirect()->route('verificacion_correo')->with('success', 'Verificación de correo eliminada correctamente');
    }

    //..................................................Grupo: Importar.....
        public function verificacion_correo_importar(Request $request)
        {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

         try {
        Excel::import(new VerificacionCorreoImport, $request->file('archivo_excel'));
            return redirect()->route('verificacion_correo')->with('success', 'Vericación de correos importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('verificacion_correo')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('verificacion_correo')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}