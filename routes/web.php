<?php

use App\Http\Controllers\AccesoriosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ControlAsignacionesController;
use App\Http\Controllers\DetalleEquiposController;
use App\Http\Controllers\ControlInspeccionesController;
use App\Http\Controllers\DetallesEstatusController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\EstacionesController;
use App\Http\Controllers\EstatusCriticosController;
use App\Http\Controllers\GestionInspeccionesController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ProveedorServiciosController;
use App\Http\Controllers\RepuestosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\SubestacionEquiposController;
use App\Http\Controllers\SubestacionesController;
use App\Http\Controllers\UsuarioEquiposController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function (){
    return view('welcome');})->middleware('auth');

Route::get('/Home', function (){
    return view('Home');
});

Route::get('/', [PermisosController::class, 'index'])->middleware('auth');
Route::view('/login', 'Auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);



Route::resource('accesorios', AccesoriosController::class)->middleware('auth');
// Route::resource('accesorios', AccesoriosController::class);
Route::resource('usuarios', UsuariosController::class)->middleware('auth');
Route::resource('detallesEstatus', DetallesEstatusController::class)->middleware('auth');
Route::resource('equipos', EquiposController::class)->middleware('auth');
Route::resource('controlAsignaciones', ControlAsignacionesController::class)->middleware('auth');
Route::resource('detallesEquipo', DetalleEquiposController::class)->middleware('auth');
Route::resource('inspecciones', GestionInspeccionesController::class)->middleware('auth');
Route::resource('responsables', UsuarioEquiposController::class)->middleware('auth');
Route::resource('proveedores', ProveedoresController::class)->middleware('auth');
Route::resource('proveedoresServicios', ProveedorServiciosController::class)->middleware('auth');
Route::resource('repuestos', RepuestosController::class)->middleware('auth');
Route::resource('servicios', ServiciosController::class)->middleware('auth');
Route::resource('categorias', CategoriasController::class)->middleware('auth');
Route::resource('subestacionEquipo', SubestacionEquiposController::class)->middleware('auth');

Route::get('/estaciones', [EstacionesController::class, 'index'])->middleware('auth');

Route::get('permiso/ShowUsusario/{idUsusario}',[ PermisosController::class, 'ShowUsusario'])->name('permiso.ShowUsusario');
Route::resource('controlInspeccion', ControlInspeccionesController::class);
Route::resource('estatusCritico', EstatusCriticosController::class);

//ESTACIONES

Route::resource('estacion', EstacionesController::class);