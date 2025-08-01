<?php

namespace App\Http\Controllers;

use App\Imports\UsuariosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\usuarios;
use App\Models\estaciones;
use App\Models\subEstacion;
use App\Models\perfiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsuariosController extends Controller
{
    //.....................................................Usuarios: LISTA.....
    public function usuarios(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $usuarios = usuarios::with('perfil', 'estacion', 'subEstacion')
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->where(function($q) use ($search) {
                        $q->where('nombre', 'like', "%$search%")
                          ->orWhere('app', 'like', "%$search%")
                          ->orWhere('apm', 'like', "%$search%")
                          ->orWhere('correo', 'like', "%$search%")
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

        return view('Dashboard.Usuario.usuarios', [
            'usuarios' => $usuarios,
            'estaciones' => estaciones::all(),
            'perfiles' => perfiles::all(),
            'subestaciones' => subEstacion::all()
        ]);
    }

    //.....................................................Usuarios: REGISTRAR.....
    public function usuarios_registrar(Request $request)
    {
        $this->validate(
            $request,
            usuarios::validationRules(),
            usuarios::validationMessages()
        );

            $img2 = "foto.jpg";

            if($request->file('foto') != '') {
            $file = $request->file('foto');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            \Storage::disk('public')->put($img2, \File::get($file));
        }

            usuarios::create([
                'nombre' => $request->nombre,
                'app' => $request->app,
                'apm' => $request->apm,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'password' => Hash::make($request->password),
                'foto' => $img2,
                'id_estacion' => $request->id_estacion,
                'id_subestacion' => $request->id_subestacion,
                'id_perfil' => $request->id_perfil
            ]);

            return redirect()->route('usuarios')->with('success', 'Usuario creado correctamente');

    }

    //.....................................................Usuarios: EDITAR.....
    public function usuarios_editar($id)
    {

        $query = usuarios::find($id);
        return view("Dashboard.Usuario.usuarios_editar", [
            'usuario' => $query,
            'estaciones' => estaciones::all(),
            'perfiles' => perfiles::all(),
            'subestaciones' => subestacion::all()
        ]);
    }

    //.....................................................Usuarios: SALVAR.....
    public function usuarios_salvar(usuarios $id, Request $request)
    {
       
        $this->validate(
            $request,
            usuarios::validationRules($id->id),
            usuarios::validationMessages()
        );

            $img2 = $request->foto2;

            if($request->file('foto1') != '') {
            $file = $request->file('foto1');
            $img = $file->getClientOriginalName();
            $ldate = date('Ymd_His_');
            $img2 = $ldate . $img;
            \Storage::disk('public')->put($img2, \File::get($file));
        }

            $query = usuarios::find($id->id);
            $query->nombre = $request->nombre;
            $query->app = $request->app;
            $query->apm = $request->apm;
            $query->telefono = $request->telefono;
            $query->correo = $request->correo;
            $query->password = Hash::make($request->password);
            $query->foto = $img2;
            $query->id_estacion = $request->id_estacion;
            $query->id_subestacion = $request->id_subestacion;
            $query->id_perfil = $request->id_perfil;
            $query->save();

            return redirect()->route("usuarios")->with('success', 'Usuario actualizado correctamente');
    }


    //..................................................Usuarios: BORRAR.....
    public function usuarios_borrar(usuarios $id)
    {
        $id->delete();
        return redirect()->route('usuarios')->with('success', 'El usuario se ha eliminado correctamente.');
    }

    //..................................................Usuarios: Importar.....
    public function usuarios_importar(Request $request)
    {
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        Excel::import(new UsuariosImport, $request->file('archivo_excel'));
            return redirect()->route('usuarios')->with('success', 'Usuarios importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('usuarios')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('usuarios')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }

    //..................................................Usuarios: BUSCAR.....
    public function buscar(Request $request)
    {
        $usuarios = usuarios::with(['perfil:id,nombre', 'subEstacion:id,nombre'])
    ->when($request->filled('nombre'), fn($q) =>
        $q->where('nombre', 'like', '%' . $request->nombre . '%'))
    ->when($request->filled('apm'), fn($q) =>
        $q->where('app', 'like', '%' . $request->apm . '%'))
    ->when($request->filled('perfil'), fn($q) =>
        $q->whereHas('perfil', fn($q2) =>
            $q2->where('nombre', $request->perfil)))
    ->when($request->filled('subestacion'), fn($q) =>
        $q->whereHas('subEstacion', fn($q2) =>
            $q2->where('nombre', $request->subestacion)))
    ->paginate(10); 


        $perfiles = perfiles::select('nombre')->get();
        $subestaciones = subEstacion::select('nombre')->get();

        return view('Dashboard.Usuario.usuarios', [
            'usuarios' => $usuarios,
            'estaciones' => estaciones::all(),
            'perfiles' => perfiles::all(),
            'subestaciones' => subEstacion::all()
        ]);
    }

    //.....................................................Usuarios: CAMBIAR FOTO.....
    public function cambiar_foto(Request $request, $id)
    {
        $usuario = usuarios::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombreArchivo = date('Ymd_His') . '_' . $file->getClientOriginalName();
            $file->storeAs('', $nombreArchivo, 'public');
            $usuario->foto = $nombreArchivo;
            $usuario->save();

            return redirect()->route('usuarios')->with('success', 'Foto actualizada correctamente.');
        }

        return redirect()->route('usuarios')->with('error', 'No se seleccionó ninguna imagen.');
    }

}
