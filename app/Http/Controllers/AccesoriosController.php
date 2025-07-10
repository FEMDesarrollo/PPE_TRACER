<?php

namespace App\Http\Controllers;

use App\Imports\AccesoriosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Equipos;
use App\Models\Accesorios;
use Carbon\Carbon;

class AccesoriosController extends Controller
{
    //.....................................................Accesorios: LISTA.....
    public function accesorios(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $accesorios = Accesorios::query()
            ->with('equipo') // Carga la relación con equipos
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where(function($q) use ($search) {
                        $q->where('nombre', 'like', "%$search%")
                          ->orWhere('marca', 'like', "%$search%")
                          ->orWhere('modelo', 'like', "%$search%")
                          ->orWhere('detalle_descripcion', 'like', "%$search%")
                          ->orWhereHas('equipo', function($q) use ($search) {
                              $q->where('nombre', 'like', "%$search%");
                          });
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

        return view('Dashboard.Accesorios.accesorios', [
            'accesorios' => $accesorios,
            'equipos' => Equipos::all()
        ]);
    }

    //.....................................................Accesorios: REGISTRAR.....
    public function accesorios_registrar(Request $request)
    {
        $this->validate($request, [
        'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
        'marca' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ.\s]+$/u', 'max:20'],
        'modelo' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:20'],
        'detalle_descripcion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]+$/u', 'max:255'],
        'id_equipo' => 'required'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',

            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'La marca solo puede contener letras, números, espacios y puntos.',
            'marca.max' => 'La marca no debe exceder los 20 caracteres.',

            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.regex' => 'El modelo solo puede contener letras, números y espacios.',
            'modelo.max' => 'El modelo no debe exceder los 20 caracteres.',

            'detalle_descripcion.required' => 'La descripción es obligatoria.',
            'detalle_descripcion.regex' => 'La descripción solo puede contener letras, números, espacios y guiones.',
            'detalle_descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',

            'id_equipo.required' => 'Debes seleccionar un equipo.',
        ]);


        $img2 = "logotipo.png";

        if($request->file('imagen') != '') {
            $file = $request->file('imagen');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            \Storage::disk('public')->put($img2, \File::get($file));
        }

        Accesorios::create([
            'nombre' => $request->nombre,
            'imagen' => $img2,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'detalle_descripcion' => $request->detalle_descripcion,
            'id_equipo' => $request->id_equipo
        ]);

        return redirect()->route('accesorios')->with('success', 'El accesorio se ha creado correctamente.');
    }

    //.....................................................Accesorios: DETALLE.....
    public function accesorios_detalle($id)
    {
        $query = Accesorios::with('equipo')->find($id);
        return view("Dashboard.Accesorios.accesorios_detalle")
            ->with(['accesorio' => $query]);
    }

    //.....................................................Accesorios: EDITAR.....
    public function accesorios_editar($id)
    {
        $query = Accesorios::find($id);
        return view("Dashboard.Accesorios.accesorios_editar", [
            'accesorio' => $query,
            'equipos' => Equipos::all()
        ]);
    }

    //.....................................................Accesorios: SALVAR.....
    public function accesorios_salvar(Accesorios $id, Request $request)
    {
        $this->validate($request, [
        'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
        'marca' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ.\s]+$/u', 'max:20'],
        'modelo' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:20'],
        'detalle_descripcion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]+$/u', 'max:255'],
        'id_equipo' => 'required'
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',

            'marca.required' => 'La marca es obligatoria.',
            'marca.regex' => 'La marca solo puede contener letras, números, espacios y puntos.',
            'marca.max' => 'La marca no debe exceder los 20 caracteres.',

            'modelo.required' => 'El modelo es obligatorio.',
            'modelo.regex' => 'El modelo solo puede contener letras, números y espacios.',
            'modelo.max' => 'El modelo no debe exceder los 20 caracteres.',

            'detalle_descripcion.required' => 'La descripción es obligatoria.',
            'detalle_descripcion.regex' => 'La descripción solo puede contener letras, números, espacios y guiones.',
            'detalle_descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',

            'id_equipo.required' => 'Debes seleccionar un equipo.',
        ]);

        $img2 = $request->imagen2;

        if($request->file('imagen1') != '') {
            $file = $request->file('imagen1');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            \Storage::disk('public')->put($img2, \File::get($file));
        }

        $query = Accesorios::find($id->id);
        $query->nombre = $request->nombre;
        $query->imagen = $img2;
        $query->marca = $request->marca;
        $query->modelo = $request->modelo;
        $query->detalle_descripcion = $request->detalle_descripcion;
        $query->id_equipo = $request->id_equipo;
        $query->save();

        return redirect()->route('accesorios')->with('success', 'El accesorio se ha actualizado correctamente.');
    }

    //.....................................................Accesorios: BORRAR.....
    public function accesorios_borrar(Accesorios $id)
    {
        $id->delete();
       return redirect()->route('accesorios')->with('success', 'El accesorio se ha eliminado correctamente.');
       return back()->with('error', 'Ocurrió un error al procesar la solicitud.');
    }


    //.....................................................Accesorios: Importar.....
    public function accesorios_importar(Request $request)
    {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new AccesoriosImport, $request->file('archivo_excel'));

        return redirect()->route('accesorios')->with('success', 'Accesorios importados correctamente.');
    }
}

