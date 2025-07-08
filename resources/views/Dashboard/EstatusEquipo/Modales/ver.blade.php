    <!-- Modal Ver -->
    <div class="modal fade" id="modalVer{{ $estatusEquipo->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalVerLabel{{ $estatusEquipo->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalVerLabel{{ $estatusEquipo->id }}" style="color: #222944;">
                        Detalles del Estado
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control" id="ver_estado{{ $estatusEquipo->id }}" 
                                value="{{ $estatusEquipo->estado }}" readonly>
                            <label for="ver_estado{{ $estatusEquipo->id }}">Estado</label>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c;">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>