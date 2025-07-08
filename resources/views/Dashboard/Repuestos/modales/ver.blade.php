<!-- Modal Ver -->
    <div class="modal fade" id="modalVer{{ $repuesto->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalVerLabel{{ $repuesto->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $repuesto->id }}" style="color: #222944;">Detalle del Repuesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control w-100" id="ver_costo{{ $repuesto->id }}" value="{{ $repuesto->costo }}" readonly>
                                <label for="ver_costo{{ $repuesto->id }}">Costo</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control w-100" id="ver_fecha_disponible{{ $repuesto->id }}" placeholder="Fecha disponible" value="{{ $repuesto->fecha_disponible }}" readonly>
                                <label for="ver_fecha_disponible{{ $repuesto->id }}">Fecha disponible</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" id="ver_id_prov_servicio{{ $repuesto->id }}" value="{{ $repuesto->prov_servicio->id }}" readonly>
                                <label for="ver_id_prov_servicio{{ $repuesto->id }}">Id de proveedor servicio</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" id="ver_id_accesorio{{ $repuesto->id }}" value="{{ $repuesto->accesorio->nombre }}" readonly>
                                <label for="id_accesorio{{ $repuesto->id }}">Accesorio</label>
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
