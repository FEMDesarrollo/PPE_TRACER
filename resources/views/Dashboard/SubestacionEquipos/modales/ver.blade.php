<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $subEE->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $subEE->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $subEE->id }}" style="color: #222944;">Detalle del Equipo de subestación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_no_traje{{ $subEE->id }}" value="{{ $subEE->no_traje ?? 'Sin Número traje' }}" readonly>
                            <label for="ver_no_traje{{ $subEE->id }}">Número traje</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_equipo{{ $subEE->id }}" value="{{ $subEE->equipo->equipo }}" readonly>
                            <label for="ver_id_equipo{{ $subEE->id }}">Equipo</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_estacion{{ $subEE->id }}" value="{{ $subEE->estacion->nombre ?? 'Sin estación' }}" readonly>
                            <label for="ver_id_estacion{{ $subEE->id }}">Estación</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_subestacion{{ $subEE->id }}" value="{{ $subEE->subestacion->nombre ?? 'Sin subestación' }}" readonly>
                            <label for="ver_id_subestacion{{ $subEE->id }}">Subestación</label>
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