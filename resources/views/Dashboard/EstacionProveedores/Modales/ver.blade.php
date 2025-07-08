<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $eproveedor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $eproveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                 <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Detalles estación de proveedores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_proveedor{{ $eproveedor->id }}" 
                                value="{{ $eproveedor->proveedor->nombre ?? 'Sin proveedor' }}" readonly>
                            <label for="ver_proveedor{{ $eproveedor->id }}">Proveedor</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_estacion{{ $eproveedor->id }}" 
                                value="{{ $eproveedor->estacion->nombre ?? 'Sin estación' }}" readonly>
                            <label for="ver_estacion{{ $eproveedor->id }}">Estación</label>
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