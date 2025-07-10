<?php

namespace App\Http\Controllers;

use App\Imports\ProveedoresImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Proveedores;
use Carbon\Carbon;

class ProveedoresController extends Controller
{
    //.....................................................Proveedores: Lista.....
    public function proveedores(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');
        
        $proveedores = Proveedores::query()
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where(function($q) use ($search) {
                        $q->where('nombre', 'like', "%$search%")
                          ->orWhere('direccion', 'like', "%$search%")
                          ->orWhere('telefono', 'like', "%$search%");
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
            
        return view('Dashboard.Proveedores.proveedores', compact('proveedores'));
    }

    //.....................................................Proveedores: REGISTRAR.....
    public function proveedores_registrar(Request $request)
    {
        $this->validate($request, [
            'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
            'direccion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
            'telefono' => ['required', 'regex:/^[0-9]{10}$/'],
        ],[
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',

            'direccion.required' => 'la dirección es obligatoria.',
            'direccion.regex' => 'La dirección solo puede contener letras, números y espacios.',
            'direccion.max' => 'La dirección no debe exceder los 30 caracteres.',

            'telefono.required' => 'El telefono es obligatorio',
            'direccion.regex' => 'EL telefono solo puede contener números',
            'direccion.max' => 'EL telefono solo tine 10 digitos.',
        ]);

        Proveedores::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);

        return redirect()->route('proveedores')->with('success', 'Proveedor registrado correctamente');
    }

    //....................................................Proveedores: detalle.....
    public function proveedores_detalle($id)
    {
        $query = Proveedores::find($id);
        return view("Dashboard.Proveedores.proveedores")
            ->with(['proveedores' => $query]);
    }

    //.....................................................Proveedores: EDITAR.....
    public function proveedores_editar($id)
    {
        $query = Proveedores::find($id);
        return view("Dashboard.Proveedores.proveedores_editar")
            ->with(['proveedores' => $query]);
    }

    //.....................................................Proveedores: SALVAR.....
    public function proveedores_salvar(Proveedores $id, Request $request)
    {
       $this->validate($request, [
            'nombre' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
            'direccion' => ['required', 'regex:/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s]+$/u', 'max:30'],
            'telefono' => ['required', 'regex:/^[0-9]{10}$/'],
        ],[
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.max' => 'El nombre no debe exceder los 30 caracteres.',

            'direccion.required' => 'la dirección es obligatoria.',
            'direccion.regex' => 'La dirección solo puede contener letras, números y espacios.',
            'direccion.max' => 'La dirección no debe exceder los 30 caracteres.',

            'telefono.required' => 'El telefono es obligatorio',
            'direccion.regex' => 'EL telefono solo puede contener números',
            'direccion.max' => 'EL telefono solo tine 10 digitos.',
        ]);

        $query = Proveedores::find($id->id);
        $query->nombre = $request->nombre;
        $query->direccion = $request->direccion;
        $query->telefono = $request->telefono;
        $query->save();

        return redirect()->route("proveedores")->with('success', 'Proveedor actualizado correctamente');
    }

    //..................................................Proveedores: Borrar.....
    public function proveedores_borrar(Proveedores $id)
    {
        $id->delete();
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado correctamente');
    }

    //..................................................Proveedores: Importar.....
    public function proveedores_importar(Request $request)
    {
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    Excel::import(new ProveedoresImport, $request->file('archivo_excel'));

    return redirect()->route('proveedores')->with('success', 'Servicios importados correctamente.');
    }
}