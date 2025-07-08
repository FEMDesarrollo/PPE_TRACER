<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $detallesta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $detallesta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title fw-bold text-center" id="modalVerLabel{{ $detallesta->id }}" style="color: #222944;">Detalles del estatus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            
            <div class="modal-body">


                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_total_respuesta{{ $detallesta->id }}" value="{{ $detallesta->total_respuesta }}" readonly>
                            <label for="ver_total_respuesta{{ $detallesta->id }}">Total de respuesta</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_estatus{{ $detallesta->id }}" value="{{ $detallesta->estatus_critico->estatus ?? 'Sin estatus' }}" readonly>
                            <label for="ver_id_estatus{{ $detallesta->id }}">Estatus</label>
                        </div>
                    </div>
                </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_usuario{{ $detallesta->id }}" value="{{ $detallesta->usuario->nombre ?? 'Sin usuario' }}" readonly>
                            <label for="ver_id_usuario{{ $detallesta->id }}">Usuario</label>
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
