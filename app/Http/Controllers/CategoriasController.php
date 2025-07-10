<?php

namespace App\Http\Controllers;

use App\Imports\CategoriasImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\equipos;
use App\Models\categorias;
use Carbon\Carbon;

class CategoriasController extends Controller
{
    //.....................................................Categorías: LISTA.....
    public function categorias(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        $equipoFilter = $request->input('equipo_filter');

        $categorias = categorias::with(['equipo'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where('categoria', 'like', "%$search%")
                          ->orWhereHas('equipo', function($q) use ($search) {
                              $q->where('equipo', 'like', "%$search%");
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
            ->when($equipoFilter, function($query) use ($equipoFilter) {
                $query->where('id_equipo', $equipoFilter);
            })
            ->orderBy('id', 'asc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'time_filter' => $timeFilter,
                'equipo_filter' => $equipoFilter
            ]);

        return view('Dashboard.Categorias.categorias', [
            'categorias' => $categorias,
            'equipos' => equipos::all()
        ]);
    }

    //.....................................................Categorías: REGISTRAR.....
    public function categorias_registrar(Request $request)
    {
        $this->validate($request, [
        'categoria' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
        'id_equipo' => 'required'
        ], [
        'categoria.required' => 'La categoría es obligatoria.',
        'categoria.regex' => 'La categoría solo puede contener letras y espacios.',
        'categoria.max' => 'La categoría no debe exceder los 100 caracteres.',

        'id_equipo.required' => 'Debes seleccionar un equipo.',
        ]);

        categorias::create([
            'categoria' => $request->categoria,
            'id_equipo' => $request->id_equipo
        ]);

        return redirect()->route('categorias')->with('success', 'Categoría registrada correctamente');
    }

    //....................................................Categorías: DETALLE.....
    public function categorias_detalle($id)
    {
        $query = categorias::with(['equipo'])->findOrFail($id);
        return view("Dashboard.Categorias.categorias_detalle")
            ->with(['categoria' => $query]);
    }

    //.....................................................Categorías: EDITAR.....
    public function categorias_editar($id)
    {
        $query = categorias::with(['equipo'])->findOrFail($id);
        return view("Dashboard.Categorias.categorias_editar")
            ->with([
                'categoria' => $query,
                'equipos' => equipos::all()
            ]);
    }

    //.....................................................Categorías: SALVAR.....
    public function categorias_salvar(categorias $id, Request $request)
    {
        $this->validate($request, [
        'categoria' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:50'],
        'id_equipo' => 'required'
        ], [
        'categoria.required' => 'La categoría es obligatoria.',
        'categoria.regex' => 'La categoría solo puede contener letras y espacios.',
        'categoria.max' => 'La categoría no debe exceder los 100 caracteres.',

        'id_equipo.required' => 'Debes seleccionar un equipo.',
        ]);

        $query = categorias::find($id->id);
        $query->categoria = $request->categoria;
        $query->id_equipo = $request->id_equipo;
        $query->save();

        return redirect()->route("categorias")->with('success', 'Categoría actualizada correctamente');
    }

    //.....................................................Categorías: BORRAR.....
    public function categorias_borrar(categorias $id)
    {
        $id->delete();
        return redirect()->route('categorias')->with('success', 'Categoría eliminada correctamente');
    }


    //.....................................................Categorías: Importar.....
    public function categorias_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new CategoriasImport, $request->file('archivo_excel'));

        return redirect()->route('categorias')->with('success', 'Categorias importados correctamente.');
    }
}
