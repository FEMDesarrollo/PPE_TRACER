<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Estaciones;
use Carbon\Carbon;

class EstacionesController extends Controller
{
    //.....................................................Grupo: Lista.....
    public function estaciones(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $estaciones = Estaciones::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where(function($q) use ($search) {
                        $q->where('nombre', 'like', "%$search%")
                          ->orWhere('direccion', 'like', "%$search%")
                          ->orWhere('telefono', 'like', "%$search%")
                          ->orWhere('total_trajes', 'like', "%$search%");
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

        return view('Dashboard.Estaciones.estaciones', compact('estaciones'));
    }

    //.....................................................Grupos: REGISTRAR.....
    public function estaciones_registrar(Request $request)
    {
        $this->validate($request, [
        'nombre' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u','max:100'],
        'direccion' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s.,&]+$/u','max:255'],
        'telefono' => ['required','regex:/^[0-9\s]+$/u','max:20'],
        'total_trajes' => ['required','integer','min:1'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 100 caracteres.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.regex' => 'La dirección solo puede contener letras, números, puntos, comas, & y espacios.',
            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo puede contener números y espacios.',
            'telefono.max' => 'El teléfono no debe exceder los 20 caracteres.',

            'total_trajes.required' => 'El total de trajes es obligatorio.',
            'total_trajes.integer' => 'El total de trajes debe ser un número entero.',
            'total_trajes.min' => 'El total de trajes debe ser al menos 1.',
        ]);

        Estaciones::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'total_trajes' => $request->total_trajes
        ]);

        return redirect()->route('estaciones')->with('success', 'Estación registrada correctamente');
    }

    //....................................................Grupo: detalle.....
    public function estaciones_detalle($id)
    {
        $query = Estaciones::find($id);
        return view("Dashboard.Estaciones.estaciones")
            ->with(['estaciones' => $query]);
    }

    //.....................................................Grupos: EDITAR.....
    public function estaciones_editar($id)
    {
        $query = Estaciones::find($id);
        return view("Dashboard.Estaciones.estaciones_editar")
            ->with(['estaciones' => $query]);
    }

    //.....................................................Grupos: SALVAR.....
    public function estaciones_salvar(Estaciones $id, Request $request)
    {
         $this->validate($request, [
        'nombre' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u','max:100'],
        'direccion' => ['required','regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s.,&]+$/u','max:255'],
        'telefono' => ['required','regex:/^[0-9\s]+$/u','max:20'],
        'total_trajes' => ['required','integer','min:1'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 100 caracteres.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.regex' => 'La dirección solo puede contener letras, números, puntos, comas, & y espacios.',
            'direccion.max' => 'La dirección no debe exceder los 255 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono solo puede contener números y espacios.',
            'telefono.max' => 'El teléfono no debe exceder los 20 caracteres.',

            'total_trajes.required' => 'El total de trajes es obligatorio.',
            'total_trajes.integer' => 'El total de trajes debe ser un número entero.',
            'total_trajes.min' => 'El total de trajes debe ser al menos 1.',
        ]);

        $query = Estaciones::find($id->id);
        $query->nombre = $request->nombre;
        $query->direccion = $request->direccion;
        $query->telefono = $request->telefono;
        $query->total_trajes = $request->total_trajes;
        $query->save();

        return redirect()->route("estaciones")->with('success', 'Estación actualizada correctamente');
    }

    //..................................................Grupo: Borrar.....
    public function estaciones_borrar(Estaciones $id)
    {
        $id->delete();
        return redirect()->route('estaciones')->with('success', 'Estación eliminada correctamente');
    }
}
