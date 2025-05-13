
    <!-- Modal de Editar -->

<div class="modal fade" id="modalEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Editar
                        Accesorio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="editarModal">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="idAccesorio">
                        <div class="col-12 col-md-4 form-floating">
                            <input type="text" class="form-control" id="nombreEdit" placeholder="Nombre"
                                >
                            <label for="nombreEdit" class="ps-4">Nombre</label>
                        </div>
                        <div class="col-12 col-md-4 form-floating">
                            <input type="text" class="form-control" id="marcaEdit"
                                placeholder="Apellido Paterno">
                            <label for="marcaEdit" class="ps-4">Marca</label>
                        </div>
                        <div class="col-12 col-md-4 form-floating">
                            <input type="text" class="form-control" id="modeloEdit"
                                placeholder="Apellido Materno">
                            <label for="modeloEdit" class="ps-4">Modelo</label>
                        </div>
                        <div class="col-12">
                            <label for="formFile">Foto del accesorio</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                        <div class="col-12">
                            <label for="equipoEdit" class="form-label">Equipo</label>
                            <select id="equipoEdit" class="form-select">
                                <option selected>Seleccione uno...</option>
                                @foreach ($equipos as $equipo)
                                    <option vaule={{ $equipo->id }}>{{ $equipo->equipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Especificaciones" id="descripcionEdit" style="height: 100px"></textarea>
                                <label for="descripcionEdit">Descripción del Accesorio</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center w-100">
                    <button type="button" class="btn" data-bs-dismiss="modal" form="editarModal"
                        style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Fin de Editar -->