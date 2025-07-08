<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\detallesEstatus;
use App\Models\estatusCritico;
use App\Models\usuarios;
use Carbon\Carbon;

class DetallesEstatusController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function detalles_estatus(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $detallesEstatus = detallesEstatus::with(['estatus_critico', 'usuario'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search)
                          ->orWhere('total_respuesta', $search);
                } else {
                    $query->where('total_respuesta', 'like', "%$search%")
                          ->orWhereHas('estatus_critico', function($q) use ($search) {
                              $q->where('estatus', 'like', "%$search%");
                          })
                          ->orWhereHas('usuario', function($q) use ($search) {
                              $q->where('name', 'like', "%$search%");
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
            
        return view('Dashboard.DetalleEstatu.detalles_estatus', [
            'detalles_estatus' => $detallesEstatus,
            'estatus_critico' => estatusCritico::all(),
            'usuario' => usuarios::all()
        ]);
    }

    //.....................................................Grupos: REGISTRAR.....
    public function detalles_estatus_registrar(Request $request)
    {
        $request->validate([
            'total_respuesta' => 'required|integer|min:0',
            'id_estatus' => 'required|exists:estatus_critico,id',
            'id_usuario' => 'required|exists:usuarios,id'
        ]);

        detallesEstatus::create([
            'total_respuesta' => $request->total_respuesta,
            'id_estatus' => $request->id_estatus,
            'id_usuario' => $request->id_usuario
        ]);

        return redirect()->route('detalles_estatus')->with('success', 'Detalle de estatus registrado correctamente');
    }

    //....................................................Grupo: detalle.....
    public function detalles_estatus_detalle($id)
    {
        $query = detallesEstatus::with(['estatus_critico', 'usuario'])->findOrFail($id);
        return view("Dashboard.DetalleEstatu.detalles_estatus_detalle")
            ->with(['detalle_estatus' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function detalles_estatus_editar($id)
    {
        $query = detallesEstatus::with(['estatus_critico', 'usuario'])->findOrFail($id);
        return view("Dashboard.DetalleEstatu.detalles_estatus_editar")
            ->with([
                'detalle_estatus' => $query,
                'estatus_critico' => estatusCritico::all(),
                'usuario' => usuarios::all()
            ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function detalles_estatus_salvar(detallesEstatus $id, Request $request)
    {
        $request->validate([
            'total_respuesta' => 'required|integer|min:0',
            'id_estatus' => 'required|exists:estatus_critico,id',
            'id_usuario' => 'required|exists:usuarios,id'
        ]);

        $query = detallesEstatus::find($id->id);
        $query->total_respuesta = $request->total_respuesta;
        $query->id_estatus = $request->id_estatus;
        $query->id_usuario = $request->id_usuario;
        $query->save();

        return redirect()->route("detalles_estatus")->with('success', 'Detalle de estatus actualizado correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function detalles_estatus_borrar(detallesEstatus $id)
    {
        $id->delete();
        return redirect()->route('detalles_estatus')->with('success', 'Detalle de estatus eliminado correctamente');
    }
}