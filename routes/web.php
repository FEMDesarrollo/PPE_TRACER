<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\EstacionesController;
use App\Http\Controllers\GestionInspeccionesController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\EstatusCriticoController;
use App\Http\Controllers\EstatusEquiposController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\AccesoriosController;
use App\Http\Controllers\SubEstacionEquiposController;
use App\Http\Controllers\RepuestosController;

// ------------------------------- De 2 ID -------------------------------------------
use App\Http\Controllers\SubEstacionController;
use App\Http\Controllers\EstacionProveedoresController;
use App\Http\Controllers\ProveedorServiciosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ControlInspeccionesController;
use App\Http\Controllers\PermisosUsuariosController;
use App\Http\Controllers\UsuariosEquiposController;
use App\Http\Controllers\ControlAsignacionesController;
use App\Http\Controllers\DetallesEquipoController;
use App\Http\Controllers\DetallesEstatusController;
use App\Http\Controllers\VerificacionCorreoController;

// ------------------------------- Ruta para descargar la plantilla -------------------------------------------
use App\Exports\PlantillaAccesorios;
use App\Exports\PlantillaCategorias;
use App\Exports\PlantillaControlAsignaciones;
use App\Exports\PlantillaControlInspecciones;
use App\Exports\PlantillaDetallesEquipo;
use App\Exports\PlantillaDetallesEstatus;
use App\Exports\PlantillaEquipos;
use App\Exports\PlantillaEstaciones;
use App\Exports\PlantillaEstacionProveedores;
use App\Exports\PlantillaEstatusCritico;
use App\Exports\PlantillaEstatusEquipos;
use App\Exports\PlantillaGestionInspecciones;
use App\Exports\PlantillaPerfiles;
use App\Exports\PlantillaPermisos;
use App\Exports\PlantillaPermisosUsuarios;
use App\Exports\PlantillaProveedores;
use App\Exports\PlantillaProveedorServicio;
use App\Exports\PlantillaRepuestos;
use App\Exports\PlantillaServicios;
use App\Exports\PlantillaSubestacion;
use App\Exports\PlantillaSubestacionEquipos;
use App\Exports\PlantillaUsuarios;
use App\Exports\PlantillaUsuariosEquipos;
use App\Exports\PlantillaVerificacionCorreo;



Route::get('/dashboard', function (){
    return view('welcome');})->middleware('auth');

Route::get('/Home', function (){
    return view('Home');
});



//---------------------------------RUTAS: Servicios
Route::get('/servicios', [ServiciosController::class, 'servicios'])->name('servicios');
Route::post('/servicio_registrar', [ServiciosController::class, 'servicio_registrar'])->name('servicio_registrar');

Route::get('/servicio_editar/{id}', [ServiciosController::class, 'servicio_editar'])->name('servicio_editar');
Route::put('/servicio_salvar/{id}', [ServiciosController::class, 'servicio_salvar'])->name('servicio_salvar');
Route::delete('/servicio_borrar/{id}', [ServiciosController::class, 'servicio_borrar'])->name('servicio_borrar');
Route::post('/servicios/importar', [ServiciosController::class, 'servicios_importar'])->name('servicios.importar');

//---------------------------------RUTAS: Proveedores
Route::name('proveedores')->get('/proveedores',[ProveedoresController::class, 'proveedores']);
Route::name('proveedores_registrar')->post('/proveedores_registrar',[ProveedoresController::class, 'proveedores_registrar']);

Route::name('proveedores_detalle')->get('/proveedores_detalle/{id}',[ProveedoresController::class, 'proveedores_detalle']);
Route::name('proveedores_editar')->get('/proveedores_editar/{id}',[ProveedoresController::class, 'proveedores_editar']);
Route::name('proveedores_salvar')->put('/proveedores_salvar/{id}',[ProveedoresController::class, 'proveedores_salvar']);
Route::name('proveedores_borrar')->delete('/proveedores_borrar/{id}',[ProveedoresController::class, 'proveedores_borrar']);
Route::post('/proveedores/importar', [ProveedoresController::class, 'proveedores_importar'])->name('proveedores.importar');


//--------------------------------- RUTAS: Estaciones ---------------------------------
Route::name('estaciones')->get('/estaciones',[EstacionesController::class, 'estaciones']);
Route::name('estaciones_registrar')->post('/estaciones_registrar',[EstacionesController::class, 'estaciones_registrar']);

Route::name('estaciones_detalle')->get('/estaciones_detalle/{id}',[EstacionesController::class, 'estaciones_detalle']);
Route::name('estaciones_editar')->get('/estaciones_editar/{id}',[EstacionesController::class, 'estaciones_editar']);
Route::name('estaciones_salvar')->put('/estaciones_salvar/{id}',[EstacionesController::class, 'estaciones_salvar']);
Route::name('estaciones_borrar')->delete('/estaciones_borrar/{id}',[EstacionesController::class, 'estaciones_borrar']);

Route::post('/estaciones/importar', [EstacionesController::class, 'estaciones_importar'])->name('estaciones.importar');

//--------------------------------- RUTAS: Gestion de inspecciones ---------------------------------
Route::name('gestion_inspecciones')->get('/gestion_inspecciones',[GestionInspeccionesController::class, 'gestion_inspecciones']);
Route::name('gestion_inspecciones_registrar')->post('/gestion_inspecciones_registrar',[GestionInspeccionesController::class, 'gestion_inspecciones_registrar']);

Route::name('gestion_inspecciones_detalle')->get('/gestion_inspecciones_detalle/{id}',[GestionInspeccionesController::class, 'gestion_inspecciones_detalle']);
Route::name('gestion_inspecciones_editar')->get('/gestion_inspecciones_editar/{id}',[GestionInspeccionesController::class, 'gestion_inspecciones_editar']);
Route::name('gestion_inspecciones_salvar')->put('/gestion_inspecciones_salvar/{id}',[GestionInspeccionesController::class, 'gestion_inspecciones_salvar']);
Route::name('gestion_inspecciones_borrar')->delete('/gestion_inspecciones_borrar/{id}',[GestionInspeccionesController::class, 'gestion_inspecciones_borrar']);
Route::post('/gestion_inspecciones/importar', [GestionInspeccionesController::class, 'gestion_inspecciones_importar'])->name('gestion_inspecciones.importar');


//--------------------------------- RUTAS: Equipos ---------------------------------
Route::name('equipos')->get('/equipos', [EquiposController::class, 'equipos']);
Route::name('equipos_registrar')->post('/equipos_registrar', [EquiposController::class, 'equipos_registrar']);

Route::name('equipos_detalle')->get('/equipos_detalle/{id}', [EquiposController::class, 'equipos_detalle']);
Route::name('equipos_editar')->get('/equipos_editar/{id}', [EquiposController::class, 'equipos_editar']);
Route::name('equipos_salvar')->put('/equipos_salvar/{id}', [EquiposController::class, 'equipos_salvar']);
Route::name('equipos_borrar')->delete('/equipos_borrar/{id}', [EquiposController::class, 'equipos_borrar']);
Route::post('/equipos/importar', [EquiposController::class, 'equipos_importar'])->name('equipos.importar');


//--------------------------------- RUTAS: Perfiles ---------------------------------
Route::name('perfiles')->get('/perfiles',[PerfilesController::class, 'perfiles']);
Route::name('perfiles_registrar')->post('/perfiles_registrar',[PerfilesController::class, 'perfiles_registrar']);

Route::name('perfiles_detalle')->get('/perfiles_detalle/{id}',[PerfilesController::class, 'perfiles_detalle']);
Route::name('perfiles_editar')->get('/perfiles_editar/{id}',[PerfilesController::class, 'perfiles_editar']);
Route::name('perfiles_salvar')->put('/perfiles_salvar/{id}',[PerfilesController::class, 'perfiles_salvar']);
Route::name('perfiles_borrar')->delete('/perfiles_borrar/{id}',[PerfilesController::class, 'perfiles_borrar']);

Route::post('/perfiles/importar', [PerfilesController::class, 'perfiles_importar'])->name('perfiles.importar');


//--------------------------------- RUTAS: Estatus ciítico ---------------------------------
Route::name('estatus_critico')->get('/estatus_critico',[EstatusCriticoController::class, 'estatus_critico']);
Route::name('estatus_critico_registrar')->post('/estatus_critico_registrar',[EstatusCriticoController::class, 'estatus_critico_registrar']);

Route::name('estatus_critico_detalle')->get('/estatus_critico_detalle/{id}',[EstatusCriticoController::class, 'estatus_critico_detalle']);
Route::name('estatus_critico_editar')->get('/estatus_critico_editar/{id}',[EstatusCriticoController::class, 'estatus_critico_editar']);
Route::name('estatus_critico_salvar')->put('/estatus_critico_salvar/{id}',[EstatusCriticoController::class, 'estatus_critico_salvar']);
Route::name('estatus_critico_borrar')->delete('/estatus_critico_borrar/{id}',[EstatusCriticoController::class, 'estatus_critico_borrar']);

Route::post('/estatus_critico/importar', [EstatusCriticoController::class, 'estatus_critico_importar'])->name('estatus_critico.importar');


//--------------------------------- RUTAS: Estatus Equipo ---------------------------------
Route::name('estatus_equipos')->get('/estatus_equipos',[EstatusEquiposController::class, 'estatus_equipos']);
Route::name('estatus_equipos_registrar')->post('/estatus_equipos_registrar',[EstatusEquiposController::class, 'estatus_equipos_registrar']);

Route::name('estatus_equipos_detalle')->get('/estatus_equipos_detalle/{id}',[EstatusEquiposController::class, 'estatus_equipos_detalle']);
Route::name('estatus_equipos_editar')->get('/estatus_equipos_editar/{id}',[EstatusEquiposController::class, 'estatus_equipos_editar']);
Route::name('estatus_equipos_salvar')->put('/estatus_equipos_salvar/{id}',[EstatusEquiposController::class, 'estatus_equipos_salvar']);
Route::name('estatus_equipos_borrar')->delete('/estatus_equipos_borrar/{id}',[EstatusEquiposController::class, 'estatus_equipos_borrar']);

Route::post('/estatus_equipos/importar', [EstatusEquiposController::class, 'estatus_equipos_importar'])->name('estatus_equipos.importar');

//--------------------------------- RUTAS: Sub Estacion ---------------------------------

Route::name('subestaciones')->get('/subestaciones',[SubEstacionController::class, 'subestaciones']);
Route::name('subestaciones_registrar')->post('/subestaciones_registrar',[SubEstacionController::class, 'subestaciones_registrar']);

Route::name('subestaciones_detalle')->get('/subestaciones_detalle/{id}',[SubEstacionController::class, 'subestaciones_detalle']);
Route::name('subestaciones_editar')->get('/subestaciones_editar/{id}',[SubEstacionController::class, 'subestaciones_editar']);
Route::name('subestaciones_salvar')->put('/subestaciones_salvar/{id}',[SubEstacionController::class, 'subestaciones_salvar']);
Route::name('subestaciones_borrar')->delete('/subestaciones_borrar/{id}',[SubEstacionController::class, 'subestaciones_borrar']);

Route::post('/subestaciones/importar', [SubEstacionController::class, 'subestacion_importar'])->name('subestacion.importar');

//--------------------------------- RUTAS: Estacion Proveedores ---------------------------------

Route::name('estacion_proveedores')->get('/estacion_proveedores',[EstacionProveedoresController::class, 'estacion_proveedores']);
Route::name('estacion_proveedores_registrar')->post('/estacion_proveedores_registrar',[EstacionProveedoresController::class, 'estacion_proveedores_registrar']);

Route::name('estacion_proveedores_detalle')->get('/estacion_proveedores_detalle/{id}',[EstacionProveedoresController::class, 'estacion_proveedores_detalle']);
Route::name('estacion_proveedores_editar')->get('/estacion_proveedores_editar/{id}',[EstacionProveedoresController::class, 'estacion_proveedores_editar']);
Route::name('estacion_proveedores_salvar')->put('/estacion_proveedores_salvar/{id}',[EstacionProveedoresController::class, 'estacion_proveedores_salvar']);
Route::name('estacion_proveedores_borrar')->delete('/estacion_proveedores_borrar/{id}',[EstacionProveedoresController::class, 'estacion_proveedores_borrar']);
Route::post('/estacion_proveedores/importar', [EstacionProveedoresController::class, 'estacion_proveedores_importar'])->name('estacion_proveedores.importar');

//.................................RUTAS: Proveedor_Servicios

Route::name('proveedor_servicios')->get('/proveedor_servicios',[ProveedorServiciosController::class, 'proveedor_servicios']);
Route::name('proveedor_servicios_registrar')->post('/proveedor_servicios_registrar',[ProveedorServiciosController::class, 'proveedor_servicios_registrar']);

Route::name('proveedor_servicios_detalle')->get('/proveedor_servicios_detalle/{id}',[ProveedorServiciosController::class, 'proveedor_servicios_detalle']);
Route::name('proveedor_servicios_editar')->get('/proveedor_servicios_editar/{id}',[ProveedorServiciosController::class, 'proveedor_servicios_editar']);
Route::name('proveedor_servicios_salvar')->put('/proveedor_servicios_salvar/{id}',[ProveedorServiciosController::class, 'proveedor_servicios_salvar']);
Route::name('proveedor_servicios_borrar')->delete('/proveedor_servicios_borrar/{id}',[ProveedorServiciosController::class, 'proveedor_servicios_borrar']);

//.................................RUTAS: Usuarios

Route::name('usuarios')->get('/usuarios',[UsuariosController::class, 'usuarios']);
Route::name('usuarios_registrar')->post('/usuarios_registrar',[UsuariosController::class, 'usuarios_registrar']);

Route::name('usuarios_detalle')->get('/usuarios_detalle/{id}',[UsuariosController::class, 'usuarios_detalle']);
Route::name('usuarios_editar')->get('/usuarios_editar/{id}',[UsuariosController::class, 'usuarios_editar']);
Route::name('usuarios_salvar')->put('/usuarios_salvar/{id}',[UsuariosController::class, 'usuarios_salvar']);
Route::name('usuarios_borrar')->delete('/usuarios_borrar/{id}',[UsuariosController::class, 'usuarios_borrar']);


Route::post('/usuarios/importar', [UsuariosController::class, 'usuarios_importar'])->name('usuarios.importar');

//.................................RUTAS: control_inspecciones

Route::name('control_inspecciones')->get('/control_inspecciones',[ControlInspeccionesController::class, 'control_inspecciones']);
Route::name('control_inspecciones_registrar')->post('/control_inspecciones_registrar',[ControlInspeccionesController::class, 'control_inspecciones_registrar']);

Route::name('control_inspecciones_detalle')->get('/control_inspecciones_detalle/{id}',[ControlInspeccionesController::class, 'control_inspecciones_detalle']);
Route::name('control_inspecciones_editar')->get('/control_inspecciones_editar/{id}',[ControlInspeccionesController::class, 'control_inspecciones_editar']);
Route::name('control_inspecciones_salvar')->put('/control_inspecciones_salvar/{id}',[ControlInspeccionesController::class, 'control_inspecciones_salvar']);
Route::name('control_inspecciones_borrar')->delete('/control_inspecciones_borrar/{id}',[ControlInspeccionesController::class, 'control_inspecciones_borrar']);
Route::post('/control_inspecciones/importar', [ControlInspeccionesController::class, 'control_inspecciones_importar'])->name('control_inspecciones.importar');

//--------------------------------- RUTAS: Permisos ---------------------------------

Route::name('permisos')->get('/permisos',[PermisosController::class, 'permisos']);
Route::name('permisos_registrar')->post('/permisos_registrar',[PermisosController::class, 'permisos_registrar']);

Route::name('permisos_detalle')->get('/permisos_detalle/{id}',[PermisosController::class, 'permisos_detalle']);
Route::name('permisos_editar')->get('/permisos_editar/{id}',[PermisosController::class, 'permisos_editar']);
Route::name('permisos_salvar')->put('/permisos_salvar/{id}',[PermisosController::class, 'permisos_salvar']);
Route::name('permisos_borrar')->delete('/permisos_borrar/{id}',[PermisosController::class, 'permisos_borrar']);

//--------------------------------- RUTAS: Permisos usuarios ---------------------------------

Route::name('permisos_usuarios')->get('/permisos_usuarios',[PermisosUsuariosController::class, 'permisos_usuarios']);
Route::name('permisos_usuarios_registrar')->post('/permisos_usuarios_registrar',[PermisosUsuariosController::class, 'permisos_usuarios_registrar']);

Route::name('permisos_usuarios_detalle')->get('/permisos_usuarios_detalle/{id}',[PermisosUsuariosController::class, 'permisos_usuarios_detalle']);
Route::name('permisos_usuarios_editar')->get('/permisos_usuarios_editar/{id}',[PermisosUsuariosController::class, 'permisos_usuarios_editar']);
Route::name('permisos_usuarios_salvar')->put('/permisos_usuarios_salvar/{id}',[PermisosUsuariosController::class, 'permisos_usuarios_salvar']);
Route::name('permisos_usuarios_borrar')->delete('/permisos_usuarios_borrar/{id}',[PermisosUsuariosController::class, 'permisos_usuarios_borrar']);
Route::post('/permisos_usuarios/importar', [PermisosUsuariosController::class, 'permisos_usuarios_importar'])->name('permisos_usuarios.importar');

//--------------------------------- RUTAS: Usuarios equipo ---------------------------------

Route::name('usuarios_equipos')->get('/usuarios_equipos',[UsuariosEquiposController::class, 'usuarios_equipos']);
Route::name('usuarios_equipos_registrar')->post('/usuarios_equipos_registrar',[UsuariosEquiposController::class, 'usuarios_equipos_registrar']);

Route::name('usuarios_equipos_detalle')->get('/usuarios_equipos_detalle/{id}',[UsuariosEquiposController::class, 'usuarios_equipos_detalle']);
Route::name('usuarios_equipos_editar')->get('/usuarios_equipos_editar/{id}',[UsuariosEquiposController::class, 'usuarios_equipos_editar']);
Route::name('usuarios_equipos_salvar')->put('/usuarios_equipos_salvar/{id}',[UsuariosEquiposController::class, 'usuarios_equipos_salvar']);
Route::name('usuarios_equipos_borrar')->delete('/usuarios_equipos_borrar/{id}',[UsuariosEquiposController::class, 'usuarios_equipos_borrar']);
Route::post('/usuarios_equipos/importar', [UsuariosEquiposController::class, 'usuarios_equipos_importar'])->name('usuarios_equipos.importar');

//--------------------------------- RUTAS: Control de Asignaciones ---------------------------------

Route::name('control_asignaciones')->get('/control_asignaciones',[ControlAsignacionesController::class, 'control_asignaciones']);
Route::name('control_asignaciones_registrar')->post('/control_asignaciones_registrar',[ControlAsignacionesController::class, 'control_asignaciones_registrar']);

Route::name('control_asignaciones_detalle')->get('/control_asignaciones_detalle/{id}',[ControlAsignacionesController::class, 'control_asignaciones_detalle']);
Route::name('control_asignaciones_editar')->get('/control_asignaciones_editar/{id}',[ControlAsignacionesController::class, 'control_asignaciones_editar']);
Route::name('control_asignaciones_salvar')->put('/control_asignaciones_salvar/{id}',[ControlAsignacionesController::class, 'control_asignaciones_salvar']);
Route::name('control_asignaciones_borrar')->delete('/control_asignaciones_borrar/{id}',[ControlAsignacionesController::class, 'control_asignaciones_borrar']);


//--------------------------------- RUTAS: Detalles equipo ---------------------------------

Route::name('detalles_equipos')->get('/detalles_equipos',[DetallesEquipoController::class, 'detalles_equipos']);
Route::name('detalles_equipos_registrar')->post('/detalles_equipos_registrar',[DetallesEquipoController::class, 'detalles_equipos_registrar']);

Route::name('detalles_equipos_detalle')->get('/detalles_equipos_detalle/{id}',[DetallesEquipoController::class, 'detalles_equipos_detalle']);
Route::name('detalles_equipos_editar')->get('/detalles_equipos_editar/{id}',[DetallesEquipoController::class, 'detalles_equipos_editar']);
Route::name('detalles_equipos_salvar')->put('/detalles_equipos_salvar/{id}',[DetallesEquipoController::class, 'detalles_equipos_salvar']);
Route::name('detalles_equipos_borrar')->delete('/detalles_equipos_borrar/{id}',[DetallesEquipoController::class, 'detalles_equipos_borrar']);

Route::post('/detalles_equipos/importar', [DetallesEquipoController::class, 'detalles_equipos_importar'])->name('DetalleEquipos.importar');

//--------------------------------- RUTAS: Detalles estatus ---------------------------------

Route::name('detalles_estatus')->get('/detalles_estatus',[DetallesEstatusController::class, 'detalles_estatus']);
Route::name('detalles_estatus_registrar')->post('/detalles_estatus_registrar',[DetallesEstatusController::class, 'detalles_estatus_registrar']);

Route::name('detalles_estatus_detalle')->get('/detalles_estatus_detalle/{id}',[DetallesEstatusController::class, 'detalles_estatus_detalle']);
Route::name('detalles_estatus_editar')->get('/detalles_estatus_editar/{id}',[DetallesEstatusController::class, 'detalles_estatus_editar']);
Route::name('detalles_estatus_salvar')->put('/detalles_estatus_salvar/{id}',[DetallesEstatusController::class, 'detalles_estatus_salvar']);
Route::name('detalles_estatus_borrar')->delete('/detalles_estatus_borrar/{id}',[DetallesEstatusController::class, 'detalles_estatus_borrar']);


//--------------------------------- RUTAS: Verificacion de correo ---------------------------------

Route::name('verificacion_correo')->get('/verificacion_correo',[VerificacionCorreoController::class, 'verificacion_correo']);
Route::name('verificacion_correo_registrar')->post('/verificacion_correo_registrar',[VerificacionCorreoController::class, 'verificacion_correo_registrar']);

Route::name('verificacion_correo_detalle')->get('/verificacion_correo_detalle/{id}',[VerificacionCorreoController::class, 'verificacion_correo_detalle']);
Route::name('verificacion_correo_editar')->get('/verificacion_correo_editar/{id}',[VerificacionCorreoController::class, 'verificacion_correo_editar']);
Route::name('verificacion_correo_salvar')->put('verificacion_correo_salvar/{id}',[VerificacionCorreoController::class, 'verificacion_correo_salvar']);
Route::name('verificacion_correo_borrar')->delete('/verificacion_correo_borrar/{id}',[VerificacionCorreoController::class, 'verificacion_correo_borrar']);

Route::post('/verificacion_correo/importar', [VerificacionCorreoController::class, 'verificacion_correo_importar'])->name('VerificacionCorreo.importar');

//.................................RUTAS: Accesorios

Route::name('accesorios')->get('/accesorios',[AccesoriosController::class, 'accesorios']);
Route::name('accesorios_registrar')->post('/accesorios_registrar',[AccesoriosController::class, 'accesorios_registrar']);

Route::name('accesorios_detalle')->get('/accesorios_detalle/{id}',[AccesoriosController::class, 'accesorios_detalle']);
Route::name('accesorios_editar')->get('/accesorios_editar/{id}',[AccesoriosController::class, 'accesorios_editar']);
Route::name('accesorios_salvar')->put('/accesorios_salvar/{id}',[AccesoriosController::class, 'accesorios_salvar']);
Route::name('accesorios_borrar')->delete('/accesorios_borrar/{id}',[AccesoriosController::class, 'accesorios_borrar']);
Route::post('/accesorios/importar', [AccesoriosController::class, 'accesorios_importar'])->name('accesorios.importar');

//.................................RUTAS: SubEstaciones Equipos

Route::name('subestacion_equipos')->get('/subestacion_equipos',[SubEstacionEquiposController::class, 'subestacion_equipos']);
Route::name('subestacion_equipos_registrar')->post('/subestacion_equipos_registrar',[SubEstacionEquiposController::class, 'subestacion_equipos_registrar']);

Route::name('subestacion_equipos_detalle')->get('/subestacion_equipos_detalle/{id}',[SubEstacionEquiposController::class, 'subestacion_equipos_detalle']);
Route::name('subestacion_equipos_editar')->get('/subestacion_equipos_editar/{id}',[SubEstacionEquiposController::class, 'subestacion_equipos_editar']);
Route::name('subestacion_equipos_salvar')->put('/subestacion_equipos_salvar/{id}',[SubEstacionEquiposController::class, 'subestacion_equipos_salvar']);
Route::name('subestacion_equipos_borrar')->delete('/subestacion_equipos_borrar/{id}',[SubEstacionEquiposController::class, 'subestacion_equipos_borrar']);

//.................................RUTAS: Categorias

Route::name('categorias')->get('/categorias',[CategoriasController::class, 'categorias']);
Route::name('categorias_registrar')->post('/categorias_registrar',[CategoriasController::class, 'categorias_registrar']);

Route::name('categorias_detalle')->get('/categorias_detalle/{id}',[CategoriasController::class, 'categorias_detalle']);
Route::name('categorias_editar')->get('/categorias_editar/{id}',[CategoriasController::class, 'categorias_editar']);
Route::name('categorias_salvar')->put('/categorias_salvar/{id}',[CategoriasController::class, 'categorias_salvar']);
Route::name('categorias_borrar')->delete('/categorias_borrar/{id}',[CategoriasController::class, 'categorias_borrar']);
Route::post('/categorias/importar', [CategoriasController::class, 'categorias_importar'])->name('categorias.importar');

//.................................RUTAS: Repuestos

Route::name('repuestos')->get('/repuestos',[RepuestosController::class, 'repuestos']);
Route::name('repuestos_registrar')->post('/repuestos_registrar',[RepuestosController::class, 'repuestos_registrar']);

Route::name('repuestos_detalle')->get('/repuestos_detalle/{id}',[RepuestosController::class, 'repuestos_detalle']);
Route::name('repuestos_editar')->get('/repuestos_editar/{id}',[RepuestosController::class, 'repuestos_editar']);
Route::name('repuestos_salvar')->put('/repuestos_salvar/{id}',[RepuestosController::class, 'repuestos_salvar']);
Route::name('repuestos_borrar')->delete('/repuestos_borrar/{id}',[RepuestosController::class, 'repuestos_borrar']);
Route::post('/repuestos/importar', [RepuestosController::class, 'repuestos_importar'])->name('repuestos.importar');


//---------------------------------RUTAS: Plantilla Excel
Route::get('/plantilla-accesorios', function () {
    return Excel::download(new PlantillaAccesorios, 'plantilla_accesorios.xlsx');
});

Route::get('/plantilla-categorias', function () {
    return Excel::download(new PlantillaCategorias, 'plantilla_categorias.xlsx');
});

Route::get('/plantilla-control-asignaciones', function () {
    return Excel::download(new PlantillaControlAsignaciones, 'plantilla_control_asignaciones.xlsx');
});

Route::get('/plantilla-control-inspecciones', function () {
    return Excel::download(new PlantillaControlInspecciones, 'plantilla_control_inspecciones.xlsx');
});

Route::get('/plantilla-detalles-equipo', function () {
    return Excel::download(new PlantillaDetallesEquipo, 'plantilla_detalles_equipo.xlsx');
});

Route::get('/plantilla-detalles-estatus', function () {
    return Excel::download(new PlantillaDetallesEstatus, 'plantilla_detalles_estatus.xlsx');
});

Route::get('/plantilla-equipos', function () {
    return Excel::download(new PlantillaEquipos, 'plantilla_equipos.xlsx');
});

Route::get('/plantilla-estaciones', function () {
    return Excel::download(new PlantillaEstaciones, 'plantilla_estaciones.xlsx');
});

Route::get('/plantilla-estacion-proveedores', function () {
    return Excel::download(new PlantillaEstacionProveedores, 'plantilla_estacion_proveedores.xlsx');
});

Route::get('/plantilla-estatus-critico', function () {
    return Excel::download(new PlantillaEstatusCritico, 'plantilla_estatus_critico.xlsx');
});

Route::get('/plantilla-estatus-equipos', function () {
    return Excel::download(new PlantillaEstatusEquipos, 'plantilla_estatus_equipos.xlsx');
});

Route::get('/plantilla-gestion-inspecciones', function () {
    return Excel::download(new PlantillaGestionInspecciones, 'plantilla_gestion_inspecciones.xlsx');
});

Route::get('/plantilla-perfiles', function () {
    return Excel::download(new PlantillaPerfiles, 'plantilla_perfiles.xlsx');
});

Route::get('/plantilla-permisos', function () {
    return Excel::download(new PlantillaPermisos, 'plantilla_permisos.xlsx');
});

Route::get('/plantilla-permisos-usuarios', function () {
    return Excel::download(new PlantillaPermisosUsuarios, 'plantilla_permisos_usuarios.xlsx');
});

Route::get('/plantilla-proveedores', function () {
    return Excel::download(new PlantillaProveedores, 'plantilla_proveedores.xlsx');
});

Route::get('/plantilla-proveedor-servicio', function () {
    return Excel::download(new PlantillaProveedorServicio, 'plantilla_proveedor_servicio.xlsx');
});

Route::get('/plantilla-repuestos', function () {
    return Excel::download(new PlantillaRepuestos, 'plantilla_repuestos.xlsx');
});

Route::get('/plantilla-servicios', function () {
    return Excel::download(new PlantillaServicios, 'plantilla_servicios.xlsx');
});

Route::get('/plantilla-subestacion', function () {
    return Excel::download(new PlantillaSubestacion, 'plantilla_subestacion.xlsx');
});

Route::get('/plantilla-subestacion-equipos', function () {
    return Excel::download(new PlantillaSubestacionEquipos, 'plantilla_subestacion_equipos.xlsx');
});

Route::get('/plantilla-usuarios', function () {
    return Excel::download(new PlantillaUsuarios, 'plantilla_usuarios.xlsx');
});

Route::get('/plantilla-usuarios-equipos', function () {
    return Excel::download(new PlantillaUsuariosEquipos, 'plantilla_usuarios_equipos.xlsx');
});

Route::get('/plantilla-verificacion-correo', function () {
    return Excel::download(new PlantillaVerificacionCorreo, 'plantilla_verificacion_correo.xlsx');
});