@extends('Layouts.app')

@section('page_title', 'Panel administrativo')
@section('subtitle', 'Reportes')

@section('content')


<div class="row">
<!-- Reporte Accesorios -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Accesorios</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Marca</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\accesorios::limit(3)->get() as $accesorio)
                        <tr>
                            <td>{{ $accesorio->nombre }}</td>
                            <td>{{ $accesorio->marca }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/accesorios" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Categorias -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Categorías</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\categorias::limit(3)->get() as $categoria)
                        <tr>
                            <td>{{ $categoria->categoria }}</td>
                            <td>{{ $categoria->equipo->equipo ?? 'Sin equipo asociado' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/categorias" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Control de asignaciones -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Control de asignación</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Fecha de asignación</th>
                            <th>Fecha de devolución</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\controlAsignaciones::limit(3)->get() as $controlasi)
                        <tr>
                            <td>{{ $controlasi->fecha_asignacion }}</td>
                            <td>{{ $controlasi->fecha_devolucion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/control_asignaciones" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Control de inspecciones -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Control de inspecciones</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Respuesta</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\controlInspecciones::limit(3)->get() as $controlins)
                        <tr>
                            <td>{{ $controlins->respuestas }}</td>
                            <td>{{ $controlins->fecha }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/control_inspecciones" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Detalles de equipos -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Detalles de equipos</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Modelo</th>
                            <th>Número de serie</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\detallesEquipo::limit(3)->get() as $detallequi)
                        <tr>
                            <td>{{ $detallequi->modelo }}</td>
                            <td>{{ $detallequi->no_serie }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/detalles_equipos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Detalles de estatus -->
@if(in_array(Auth::user()->id_perfil, [1, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Detalles de estatus</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Total de respuesta</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\detallesEstatus::limit(3)->get() as $detallesta)
                        <tr>
                            <td>{{ $detallesta->total_respuesta }}</td>
                            <td>{{ $detallesta->estatus_critico->estatus ?? 'Sin estatus' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/detalles_estatus" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Equipos -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Equipos</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\equipos::limit(3)->get() as $equipo)
                        <tr>
                            <td>{{ $equipo->equipo }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/equipos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Estaciones -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Estaciones</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\estaciones::limit(3)->get() as $estacion)
                        <tr>
                            <td>{{ $estacion->nombre }}</td>
                            <td>{{ $estacion->direccion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/estaciones" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Estacion proveedores -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Estacion proveedores</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Estación</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\estacionProveedores::limit(3)->get() as $eproveedor)
                        <tr>
                            <td>{{ $eproveedor->proveedor->nombre ?? 'Sin proveedor' }}</td>
                            <td>{{ $eproveedor->estacion->nombre ?? 'Sin estación' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/estacion_proveedores" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Estatus crítico -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Estatus crítico</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\EstatusCritico::limit(3)->get() as $estado)
                        <tr>
                            <td>{{ $estado->estatus }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/estatus_critico" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Estatus de equipos -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Estatus de equipo</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\estatusEquipos::limit(3)->get() as $estatusEquipo)
                        <tr>
                            <td>{{ $estatusEquipo->estado }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/estatus_equipos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Gestion de inspecciones -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Gestion de inspecciones</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\gestionInspecciones::limit(3)->get() as $gestionInspeccion)
                        <tr>
                            <td>{{ $gestionInspeccion->observaciones }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/gestion_inspecciones" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Perfiles -->
@if(Auth::user()->id_perfil == 1)
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Perfiles</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\perfiles::limit(3)->get() as $perfil)
                        <tr>
                            <td>{{ $perfil->nombre }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/perfiles" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Permisos -->
@if(Auth::user()->id_perfil == 1)
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Permisos</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Permiso</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\permisos::limit(3)->get() as $permiso)
                        <tr>
                            <td>{{ $permiso->permiso }}</td>
                            <td>{{ $permiso->url }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/permisos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Permisos usuarios -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Permisos de usuario</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Permiso</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\permisosUsuarios::limit(3)->get() as $permisouser)
                        <tr>
                            <td>{{ $permisouser->usuario->nombre ?? 'Sin usuario' }}</td>
                            <td>{{ $permisouser->permiso->permiso ?? 'Sin permiso' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/permisos_usuarios" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Proveedores -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Proveedores</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\proveedores::limit(3)->get() as $proveedor)
                        <tr>
                            <td>{{ $proveedor->nombre }}</td>
                            <td>{{ $proveedor->direccion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/proveedores" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Proveedor servicios -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Proveedores servicios</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\ProveedorServicio::limit(3)->get() as $proveedor_s)
                        <tr>
                            <td>{{ $proveedor_s->servicio->servicio ?? 'N/A' }}</td>
                            <td>{{ $proveedor_s->proveedor->nombre ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/proveedor_servicios" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Repuestos -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Repuestos</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Costo</th>
                            <th>Fecha de disponibilidad</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\repuestos::limit(3)->get() as $repuesto)
                        <tr>
                            <td>{{ $repuesto->costo }}</td>
                            <td>{{ $repuesto->fecha_disponible }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/repuestos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Servicios -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Servicios</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\servicios::limit(3)->get() as $servicio)
                        <tr>
                            <td>{{ $servicio->servicio }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/servicios" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Subestaciones -->
@if(in_array(Auth::user()->id_perfil, [1, 2, 3]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Subestaciones</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Subestacion::limit(3)->get() as $sestacion)
                        <tr>
                            <td>{{ $sestacion->nombre }}</td>
                            <td>{{ $sestacion->direccion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/subestaciones" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Subestacion equipos -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Subestaciones de equipos</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Número de traje</th>
                            <th>Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\subestacionEquipos::limit(3)->get() as $subEE)
                        <tr>
                            <td>{{ $subEE->no_traje }}</td>
                            <td>{{ $subEE->equipo->equipo }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/subestacion_equipos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Usuarios -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Usuarios</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estación</th>
                            <th>Subestación</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\usuarios::limit(3)->get() as $user)
                        <tr>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->estacion->nombre ?? 'Sin estación' }}</td>
                            <td>{{ $user->subEstacion->nombre ?? 'Sin sub-estación' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/usuarios" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Usuarios de equipo -->
@if(in_array(Auth::user()->id_perfil, [1, 2]))
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Usuarios de equipo</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Estatus de equipo</th>
                            <th>Usuario</th>
                            <th>Equipo</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\usuariosEquipos::limit(3)->get() as $userequipo)
                        <tr>
                            <td>{{ $userequipo->estatus_equipos->estado ?? 'Sin estatus de equipo' }}</td>
                            <td>{{ $userequipo->usuarios->nombre ?? 'Sin usuario' }}</td>
                            <td>{{ $userequipo->equipos->equipo ?? 'Sin equipo' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/usuarios_equipos" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

<!-- Reporte Verificacion de correo -->
@if(Auth::user()->id_perfil == 1)
    <div class="col-md-4 mb-4">
        <div class="card card-hover">
            <div class="card-header text-center fw-bold">Reporte de Verificacion de correo</div>
            <div class="card-body" style="height:200px; overflow:auto">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Código de verificación</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\verificacionCorreo::limit(3)->get() as $verico)
                        <tr>
                            <td>{{ $verico->codigo_verificacion }}</td>
                            <td>{{ $verico->fecha }}</td>
                            <td>{{ $verico->usuarios->nombre ?? 'Sin usuario' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="/verificacion_correo" class="btn btn-primary btn-sm">Ver completo</a>
            </div>
        </div>
    </div>
@endif

</div>
@endsection
