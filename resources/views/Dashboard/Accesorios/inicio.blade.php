@extends('Layouts.app')
@section('title', 'PPE TRACER')
@section('page_title', 'PANEL ADMINISTRATIVO')
@section('subtitle', ' Accesorios')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Contenedor superior de tabla -->
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 p-4 gap-3">
                            <!-- Selector de entradas -->
                            <div class="col-12 col-md-4 d-flex align-items-center gap-2">
                                <select id="entries" class="form-select form-select-sm w-auto">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                </select>
                                <label for="entries" class="mb-0">Entradas por página</label>
                            </div>
                            <!-- Buscador de tabla -->
                            <div class="col-12 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 border-bottom">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control border-0 border-bottom"
                                        placeholder="Buscar nombre...">
                                </div>
                            </div>
                            <!-- Botón Agregar en tabla -->
                            <div class="col-12 col-md-4 text-md-end">
                                <button class="btn me-md-2" data-bs-toggle="modal" data-bs-target="#modalAñadir"
                                    style="background-color: #222944; color: white; border-color:#222944;">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" data-bs-target="#Accesorios" id="tablaAccesorios">
                                <thead class="border-0 border-bottom-0">
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Equipo</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table">
                                    @foreach ($indexAccesorios as $accesorios)
                                        <tr>
                                            <td> </td>
                                            <td>{{ $accesorios->nombre }} </td>
                                            <td>{{ $accesorios->marca }} </td>
                                            <td>{{ $accesorios->modelo }} </td>
                                            <td>{{ $accesorios->equipos->equipo }} </td>
                                            <td>{{ $accesorios->detalle_descripcion }} </td>
                                            <td>
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditar" style="color: #222944">
                                                        <i class="bi bi-pencil-square fs-5"></i>
                                                    </button>
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminar" style="color: #cf0a2c">
                                                        <i class="bi bi-trash fs-5"></i>
                                                    </button>
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#modalVer" style="color: #212121">
                                                        <i class="bi bi-eye fs-5"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Contenedor inferior de tabla -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                            <!-- Mostrando usuarios -->
                            <span class="text-bling fw-bold p-3" style="color: #222944">Mostrando del 1 al 5 de 50
                                accesorios</span>
                            <!-- Botón Exportar de tabla -->
                            <button class="btn"
                                style="background-color: #222944; color: white; border-color:#222944">Exportar
                                información</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Modal de Añadir -->
  @include('Dashboard.Accesorios.modales.agregar')

    <!-- Modal de Editar -->
    @include('Dashboard.Accesorios.modales.editar')

    <!-- Modal de Eliminar -->
    @include('Dashboard.Accesorios.modales.eliminar')

    <!-- Modal de Ver -->
    @include('Dashboard.Accesorios.modales.ver')

@endsection
