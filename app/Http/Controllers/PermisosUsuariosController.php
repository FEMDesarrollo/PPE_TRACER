<?php

namespace App\Http\Controllers;

use App\Imports\PermisosUsuariosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\PermisosUsuarios;
use App\Models\Usuarios;
use App\Models\Permisos;
use Carbon\Carbon;

class PermisosUsuariosController extends Controller
{
    //.....................................................Permisos usuarios: LISTA.....
    public function permisos_usuarios(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');
        $timeFilter = $request->input('time_filter');

        $permisosUsuarios = PermisosUsuarios::with(['usuario', 'permiso'])
            ->when($search, function($query) use ($search) {
                if (is_numeric($search) && ctype_digit($search)) {
                    $query->where('id', $search);
                } else {
                    $query->whereHas('usuario', function($q) use ($search) {
                        $q->where('nombre', 'like', "%$search%");
                    })->orWhereHas('permiso', function($q) use ($search) {
                        $q->where('permiso', 'like', "%$search%");
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

        return view('Dashboard.PermisoUsuario.permisos_usuarios', [
            'permisos_usuarios' => $permisosUsuarios,
            'usuarios' => Usuarios::all(),
            'permisos' => Permisos::all()
        ]);
    }

    //.....................................................Permisos usuarios: REGISTRAR.....
    public function permisos_usuarios_registrar(Request $request)
    {
        $this->validate(
            $request,
            PermisosUsuarios::validationRules(),
            PermisosUsuarios::validationMessages()
        );

        PermisosUsuarios::create([
            'id_usuario' => $request->id_usuario,
            'id_permiso' => $request->id_permiso,
            'activo' => $request->activo
        ]);

        return redirect()->route('permisos_usuarios')->with('success', 'Permiso de usuario registrado correctamente');
    }

    //....................................................Permisos usuarios: DETALLE.....
    public function permisos_usuarios_detalle($id)
    {
        $query = PermisosUsuarios::with(['usuario', 'permiso'])->findOrFail($id);
        return view("Dashboard.PermisoUsuario.permisos_usuarios_detalle", [
            'permiso_usuario' => $query,
            'usuarios' => Usuarios::all(),
            'permisos' => Permisos::all()
        ]);
    }

    //.....................................................Permisos usuarios: EDITAR.....
    public function permisos_usuarios_editar($id)
    {
        $query = PermisosUsuarios::with(['usuario', 'permiso'])->findOrFail($id);
        return view("Dashboard.PermisoUsuario.permisos_usuarios_editar", [
            'permiso_usuario' => $query,
            'usuarios' => Usuarios::all(),
            'permisos' => Permisos::all()
        ]);
    }

    //.....................................................Permisos usuarios: SALVAR.....
    public function permisos_usuarios_salvar(PermisosUsuarios $id, Request $request)
    {
        $this->validate(
            $request,
            PermisosUsuarios::validationRules(),
            PermisosUsuarios::validationMessages()
        );

        $query = PermisosUsuarios::findOrFail($id->id);
        $query->id_usuario = $request->id_usuario;
        $query->id_permiso = $request->id_permiso;
        $query->activo = $request->activo;
        $query->save();

        return redirect()->route("permisos_usuarios")->with('success', 'Permiso de usuario actualizado correctamente');
    }

    //.....................................................Permisos usuarios: BORRAR.....
    public function permisos_usuarios_borrar(PermisosUsuarios $id)
    {
        $id->delete();
        return redirect()->route('permisos_usuarios')->with('success', 'Permiso de usuario eliminado correctamente');
    }

    //.....................................................Permisos usuarios: Importar.....
    public function permisos_usuarios_importar(Request $request)
    {
    $request->validate([
        'archivo_excel' => 'required|file|mimes:xlsx,xls'
    ]);

    try {
        Excel::import(new PermisosUsuariosImport, $request->file('archivo_excel'));
            return redirect()->route('permisos_usuarios')->with('success', 'Permisos de usuarios importados correctamente.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: {$failure->errors()[0]}";
            }

            return redirect()->route('permisos_usuarios')
                ->with('error', 'Error en la importación:')
                ->with('errorDetails', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->route('permisos_usuarios')
                ->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}
