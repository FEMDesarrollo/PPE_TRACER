       <!-- Modal Ver -->
        <div class="modal fade" id="modalVer{{ $estacion->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalVerLabel{{ $estacion->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title fw-bold text-center" id="modalVerLabel{{ $estacion->id }}" style="color: #222944;">Detalles de la estación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" id="ver_nombreEstacion{{ $estacion->id }}"
                                        value="{{ $estacion->nombre }}" readonly>
                                    <label for="ver_nombreEstacion{{ $estacion->id }}">Nombre</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" id="ver_direccion{{ $estacion->id }}"
                                        value="{{ $estacion->direccion }}" readonly>
                                    <label for="ver_direccion{{ $estacion->id }}">Dirección</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" id="ver_telefono{{ $estacion->id }}"
                                        value="{{ $estacion->telefono }}" readonly>
                                    <label for="ver_telefono{{ $estacion->id }}">Teléfono</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" id="ver_total_trajes{{ $estacion->id }}"
                                        value="{{ $estacion->total_trajes }}" readonly>
                                    <label for="ver_total_trajes{{ $estacion->id }}">Total de trajes</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
