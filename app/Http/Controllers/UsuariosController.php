<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\usuarios;
use App\Models\estaciones;
use App\Models\subEstacion;
use App\Models\perfiles;
use App\Imports\UsuariosImport;
use Maatwebsite\Excel\Facades\Excel;

class UsuariosController extends Controller
{
    //.....................................................Grupo: Lista.....
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

    //.....................................................Grupos: REGISTRAR.....
    public function usuarios_registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'app' => 'required',
            'apm' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required',
            'id_estacion' => 'required',
            'id_subestacion' => 'required',
            'id_perfil' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'correo.unique' => 'El correo electrónico ya está registrado en el sistema',
            'foto.image' => 'El archivo debe ser una imagen válida',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif',
            'foto.max' => 'La imagen no debe pesar más de 2MB'
        ]);

        try {
            $img2 = "foto.jpg";

            if($request->hasFile('foto')) {
                $file = $request->file('foto');
                $img = $file->getClientOriginalName();
                $ldate = date('Ymd_His_');
                $img2 = $ldate . $img;
                Storage::disk('public')->put($img2, file_get_contents($file));
            }

            $usuario = usuarios::create([
                'nombre' => $request->nombre,
                'app' => $request->app,
                'apm' => $request->apm,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'password' => $request->password, // Se recomienda encriptar la contraseña
                'foto' => $img2,
                'id_estacion' => $request->id_estacion,
                'id_subestacion' => $request->id_subestacion,
                'id_perfil' => $request->id_perfil
            ]);

            return redirect()->route('usuarios')
                ->with('success', 'Usuario creado correctamente');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Ocurrió un error al registrar el usuario: ' . $e->getMessage());
        }
    }

    //.....................................................Grupos: EDITAR.....
    public function usuarios_editar($id)
    {
        $usuario = usuarios::with(['perfil', 'estacion', 'subEstacion'])->findOrFail($id);

        return view("Dashboard.Usuario.usuarios_editar", [
            'usuario' => $usuario,
            'estaciones' => estaciones::all(),
            'perfiles' => perfiles::all(),
            'subestaciones' => subEstacion::where('id_estacion', $usuario->id_estacion)->get()
        ]);
    }

    //.....................................................Grupos: SALVAR.....
    public function usuarios_salvar(usuarios $id, Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'app' => 'required',
            'apm' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique:usuarios,correo,'.$id->id,
            'password' => 'sometimes|required',
            'id_estacion' => 'required',
            'id_subestacion' => 'required',
            'id_perfil' => 'required',
            'foto1' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $fot2 = $id->foto; // Mantener la foto actual por defecto

            if($request->hasFile('foto1')) {
                // Eliminar la foto anterior si no es la por defecto
                if($id->foto != 'foto.jpg') {
                    Storage::disk('public')->delete($id->foto);
                }

                $file = $request->file('foto1');
                $foto = $file->getClientOriginalName();
                $ldate = date('Ymd_His_');
                $fot2 = $ldate . $foto;
                Storage::disk('public')->put($fot2, file_get_contents($file));
            }

            $id->update([
                'nombre' => $request->nombre,
                'app' => $request->app,
                'apm' => $request->apm,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'password' => $request->password ? $request->password : $id->password,
                'foto' => $fot2,
                'id_estacion' => $request->id_estacion,
                'id_subestacion' => $request->id_subestacion,
                'id_perfil' => $request->id_perfil
            ]);

            return redirect()->route("usuarios")
                ->with('success', 'Usuario actualizado correctamente');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Ocurrió un error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    //..................................................Grupo: Borrar.....
    public function usuarios_borrar(usuarios $id)
    {
        try {
            // Eliminar la foto asociada si no es la por defecto
            if($id->foto != 'foto.jpg') {
                Storage::disk('public')->delete($id->foto);
            }

            $id->delete();

            return redirect()->route('usuarios')
                ->with('success', 'Usuario eliminado correctamente');

        } catch (\Exception $e) {
            return redirect()->route('usuarios')
                ->with('error', 'Ocurrió un error al eliminar el usuario: ' . $e->getMessage());
        }

    }
            //..................................................Grupo: Importar.....
        public function usuarios_importar(Request $request)
        {
        $request->validate([
            'archivo_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new UsuariosImport, $request->file('archivo_excel'));

        return redirect()->route('usuarios')->with('success', 'Usuarios importados correctamente.');
        }
    }
