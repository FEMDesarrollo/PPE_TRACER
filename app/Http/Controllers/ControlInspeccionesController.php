<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\ControlInspecciones;
use App\Models\usuarios;
use App\Models\GestionInspecciones;
use Carbon\Carbon;

class ControlInspeccionesController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function control_inspecciones(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $controlInspecciones = ControlInspecciones::with(['usuarios', 'gestionInspecciones'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('respuestas', 'like', "%$search%")
                          ->orWhere('descripcion', 'like', "%$search%")
                          ->orWhereHas('usuarios', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
                          })
                          ->orWhereHas('gestionInspecciones', function($q) use ($search) {
                              $q->where('observaciones', 'like', "%$search%");
                          });
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
                    case 'last_3_months':
                        $query->where('fecha', '>=', $now->copy()->subMonths(3)->toDateString());
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
            
        return view('Dashboard.ControlInspecciones.control_inspecciones', [
            'controlInspecciones' => $controlInspecciones,
            'usuarios' => usuarios::all(),
            'gestion_inspecciones' => GestionInspecciones::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function control_inspecciones_registrar(Request $request)
    {
        $request->validate([
            'respuestas' => 'required',
            'fecha' => 'required|date',
            'descripcion' => 'required',
            'id_usuario' => 'required|exists:usuarios,id',
            'id_gestion_inspeccion' => 'required|exists:gestion_inspecciones,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $img2 = "imagen.jpg";
            if($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $img = $file->getClientOriginalName();
                $ldate = date('Ymd_His_');
                $img2 = $ldate . $img;
                Storage::disk('public')->put($img2, file_get_contents($file));
            }

            ControlInspecciones::create([
                'respuestas' => $request->respuestas,
                'fecha' => $request->fecha,
                'imagen' => $img2,
                'descripcion' => $request->descripcion,
                'id_usuario' => $request->id_usuario,
                'id_gestion_inspeccion' => $request->id_gestion_inspeccion
            ]);

            return redirect()->route('control_inspecciones')->with('success', 'Control de inspección registrado correctamente');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al registrar: ' . $e->getMessage());
        }
    }

    //.....................................................Grupos: EDITAR.....
    public function control_inspecciones_editar($id)
    {
        $control = ControlInspecciones::with(['usuarios', 'gestionInspecciones'])->findOrFail($id);
        return view('Dashboard.ControlInspecciones.control_inspecciones_editar', [
            'control_inspecciones' => $control,
            'usuarios' => usuarios::all(),
            'gestion_inspecciones' => GestionInspecciones::all()
        ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function control_inspecciones_salvar(ControlInspecciones $id, Request $request)
    {
        $request->validate([
            'respuestas' => 'required',
            'fecha' => 'required|date',
            'descripcion' => 'required',
            'id_usuario' => 'required|exists:usuarios,id',
            'id_gestion_inspeccion' => 'required|exists:gestion_inspecciones,id',
            'imagen1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $img2 = $request->imagen2;
            if($request->hasFile('imagen1')) {
                // Delete old image if exists
                if($img2 && $img2 != "imagen.jpg" && Storage::disk('public')->exists($img2)) {
                    Storage::disk('public')->delete($img2);
                }
                
                $file = $request->file('imagen1');
                $imagen = $file->getClientOriginalName();
                $ldate = date('Ymd_His_');
                $img2 = $ldate . $imagen;
                Storage::disk('public')->put($img2, file_get_contents($file));
            }

            $id->update([
                'respuestas' => $request->respuestas,
                'fecha' => $request->fecha,
                'imagen' => $img2,
                'descripcion' => $request->descripcion,
                'id_usuario' => $request->id_usuario,
                'id_gestion_inspeccion' => $request->id_gestion_inspeccion
            ]);

            return redirect()->route('control_inspecciones')->with('success', 'Control de inspección actualizado correctamente');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    //..................................................Grupo: Borrar.....
    public function control_inspecciones_borrar(ControlInspecciones $id)
    {
        try {
            // Delete associated image if exists
            if($id->imagen && $id->imagen != "imagen.jpg" && Storage::disk('public')->exists($id->imagen)) {
                Storage::disk('public')->delete($id->imagen);
            }
            
            $id->delete();
            return redirect()->route('control_inspecciones')->with('success', 'Control de inspección eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('control_inspecciones')->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}