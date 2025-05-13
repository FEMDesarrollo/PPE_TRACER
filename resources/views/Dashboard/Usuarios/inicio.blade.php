@extends('Layouts.app')
@section('title', 'PPE TRACER')
@section('page_title', 'PANEL ADMINISTRATIVO')
@section('subtitle', ' Usuarios')
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
                                        placeholder="Buscar...">
                                </div>
                            </div>
                            <!-- Botón Agregar en tabla -->
                            <div class="col-12 col-md-4 text-md-end">
                                <button class="btn me-md-2" data-bs-toggle="modal" data-bs-target="#modalAñadir"
                                    style="background-color: #222944; color: white; border-color:#222944;">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="border-0 border-bottom-0">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido Parterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Telefono</th>
                                        <th>Correo</th>
                                        <th>Estacion</th>
                                        <th>SubEstacion</th>
                                        <th>Perfil</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table">
                                    <tr>
                                        <td>Dany</td>
                                        <td>Genaro</td>
                                        <td>Olivares</td>
                                        <td>33476764</td>
                                        <td>dany@gmail.com</td>
                                        <td>Toluca</td>
                                        <td>Rescate</td>
                                        <td>Administrador</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
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
                                </tbody>
                            </table>
                        </div>
                        <!-- Contenedor inferior de tabla -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                            <!-- Mostrando usuarios -->
                            <span class="text-bling fw-bold p-3" style="color: #222944">Mostrando del 1 al 5 de 50
                                Usuarios</span>
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
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre">
                            <label for="nombreUsuario" class="ps-4">Nombre</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="apellidoPaterno" placeholder="Apellido Paterno">
                            <label for="apellidoPaterno" class="ps-4">Apellido Paterno</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="apellidoMaterno" placeholder="Apellido Materno">
                            <label for="apellidoMaterno" class="ps-4">Apellido Materno</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="tel" class="form-control" id="telefono" placeholder="Número Telefónico">
                            <label for="telefono" class="ps-4">Número de Teléfono</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="email" class="form-control" id="correoElectronico"
                                placeholder="Correo Electrónico">
                            <label for="correoElectronico" class="ps-4">Correo Electrónico</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Contraseña">
                            <label for="password" class="ps-4">Password</label>
                        </div>
                        <div class="col-12">
                            <label for="formFile">Foto de Perfil</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="rolUsuario" class="form-label">Rol de Usuario</label>
                            <select id="rolUsuario" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="estacion" class="form-label">Estación</label>
                            <select id="estacion" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Lerma</option>
                                <option value="2">Toluca</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="subEstacion" class="form-label">Sub-Estación</label>
                            <select id="subEstacion" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Rescatista</option>
                                <option value="2">Incendios</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center w-100">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Fin de Añadir -->

    <!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre">
                            <label for="nombreUsuario" class="ps-4">Nombre</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="apellidoPaterno" placeholder="Apellido Paterno">
                            <label for="apellidoPaterno" class="ps-4">Apellido Paterno</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="apellidoMaterno" placeholder="Apellido Materno">
                            <label for="apellidoMaterno" class="ps-4">Apellido Materno</label>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="tel" class="form-control" id="telefono" placeholder="Número Telefónico">
                            <label for="telefono" class="ps-4">Número de Teléfono</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="email" class="form-control" id="correoElectronico"
                                placeholder="Correo Electrónico">
                            <label for="correoElectronico" class="ps-4">Correo Electrónico</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Contraseña">
                            <label for="password" class="ps-4">Password</label>
                        </div>
                        <div class="col-12">
                            <label for="formFile">Foto de Perfil</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="rolUsuario" class="form-label">Rol de Usuario</label>
                            <select id="rolUsuario" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="estacion" class="form-label">Estación</label>
                            <select id="estacion" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Lerma</option>
                                <option value="2">Toluca</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="subEstacion" class="form-label">Sub-Estación</label>
                            <select id="subEstacion" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Rescatista</option>
                                <option value="2">Incendios</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center w-100">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Editar -->

    <!-- Modal de Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header border-0 position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 p-3" data-bs-dismiss="modal"
                        aria-label="Close" style="color: red;"></button>
                </div>
                <div class="modal-body">
                    <i class="bi bi-exclamation-triangle fs-1 text-danger"></i>
                    <p class="mt-3 fw-bold" style="color: #222944">¿Estás seguro de que deseas eliminar este usuario?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Eliminar -->

    <!-- Modal de Ver -->
    <div class="modal fade" id="modalVer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Información del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Foto de perfil centrada -->
                <div class="text-center mt-3">
                    <img src="../img/Perfil.png" alt="Foto de Perfil" class="rounded-circle img-fluid"
                        style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-12 col-sm-6 form-floating">
                            <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre">
                            <label for="nombreUsuario" class="ps-4">Nombre</label>
                        </div>
                        <div class="col-12 col-sm-6 form-floating">
                            <input type="text" class="form-control" id="apellidoPaterno" placeholder="Apellido Paterno">
                            <label for="apellidoPaterno" class="ps-4">Apellido Paterno</label>
                        </div>
                        <div class="col-12 col-sm-6 form-floating">
                            <input type="text" class="form-control" id="apellidoMaterno" placeholder="Apellido Materno">
                            <label for="apellidoMaterno" class="ps-4">Apellido Materno</label>
                        </div>
                        <div class="col-12 col-sm-6 form-floating">
                            <input type="tel" class="form-control" id="telefono" placeholder="Número Telefónico">
                            <label for="telefono" class="ps-4">Número de Teléfono</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="email" class="form-control" id="correoElectronico"
                                placeholder="Correo Electrónico">
                            <label for="correoElectronico" class="ps-4">Correo Electrónico</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Contraseña">
                            <label for="password" class="ps-4">Password</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="rolUsuario" class="form-label">Rol de Usuario</label>
                            <select id="rolUsuario" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="estacion" class="form-label">Estación</label>
                            <select id="estacion" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Lerma</option>
                                <option value="2">Toluca</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="subEstacion" class="form-label">Sub-Estación</label>
                            <select id="subEstacion" class="form-select">
                                <option selected>Seleccione uno...</option>
                                <option value="1">Rescatista</option>
                                <option value="2">Incendios</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Ver-->
@endsection