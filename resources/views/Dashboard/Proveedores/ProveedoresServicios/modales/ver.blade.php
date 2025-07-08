<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $proveedor_s->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $proveedor_s->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalVerLabel{{ $proveedor_s->id }}" style="color: #222944;">Detalles de Proveedor Servicios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_servicio{{ $proveedor_s->id }}" value="{{ $proveedor_s->servicio->servicio ?? 'Sin Servicio' }}" readonly>
                            <label for="ver_id_servicio{{ $proveedor_s->id }}">Servicio</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_proveedor{{ $proveedor_s->id }}" value="{{ $proveedor_s->proveedor->nombre ?? 'Sin Proveedor' }}" readonly>
                            <label for="ver_id_proveedor{{ $proveedor_s->id }}">Proveedor</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Ver --> 