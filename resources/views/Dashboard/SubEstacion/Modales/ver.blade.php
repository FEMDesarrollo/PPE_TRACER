<!-- Modal Ver -->
    <div class="modal fade" id="modalVer{{ $sestacion->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalVerLabel{{ $sestacion->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Detalle subestación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" id="ver_nombreUsuario{{ $sestacion->id }}" value="{{ $sestacion->nombre }}" readonly>
                                <label for="ver_nombreUsuario{{ $sestacion->id }}">Nombre</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" id="ver_direccion{{ $sestacion->id }}" value="{{ $sestacion->direccion }}" readonly>
                                <label for="ver_direccion{{ $sestacion->id }}">Dirección</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" id="ver_telefono{{ $sestacion->id }}" value="{{ $sestacion->telefono }}" readonly>
                                <label for="ver_telefono{{ $sestacion->id }}">Teléfono</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" id="ver_id_estacion{{ $sestacion->id }}" value="{{ $sestacion->estacion->nombre ?? 'Sin estación' }}" readonly>
                                <label for="ver_id_estacion{{ $sestacion->id }}">Estación</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal de Ver -->
