<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $verico->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $verico->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title w-100 text-center fw-bold" id="modalVerLabel{{ $verico->id }}" style="color: #222944;">Detalle de verificación de correo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_codigo_verificacion{{ $verico->id }}" value="{{ $verico->codigo_verificacion }}" readonly>
                            <label for="ver_codigo_verificacion{{ $verico->id }}">Codigo de verificación</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_fecha{{ $verico->id }}" value="{{ $verico->fecha }}" readonly>
                            <label for="ver_fecha{{ $verico->id }}">Fecha</label>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_usuario{{ $verico->id }}" value="{{ $verico->usuarios->nombre ?? 'Sin usuario' }}" readonly>
                            <label for="ver_id_usuario{{ $verico->id }}">Usuario</label>
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

