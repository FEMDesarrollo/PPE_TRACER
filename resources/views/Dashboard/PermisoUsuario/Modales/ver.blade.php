<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $permisouser->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $permisouser->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalVerLabel{{ $permisouser->id }}" style="color: #222944;">Detalles del permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6 form-floating">
                        <input type="text" class="form-control" id="ver_usuario_{{ $permisouser->id }}" 
                            value="{{ $permisouser->usuario->nombre ?? 'Sin usuario' }}" readonly>
                        <label for="ver_usuario_{{ $permisouser->id }}">Usuario</label>
                    </div>
                    <div class="col-12 col-md-6 form-floating">
                        <input type="text" class="form-control" id="ver_permiso_{{ $permisouser->id }}" 
                            value="{{ $permisouser->permiso->permiso ?? 'Sin permiso' }}" readonly>
                        <label for="ver_permiso_{{ $permisouser->id }}">Permiso</label>
                    </div>
                    <div class="col-12 col-md-6 form-floating">
                        <input type="text" class="form-control" id="ver_estado_{{ $permisouser->id }}" 
                            value="{{ $permisouser->activo ? 'Activo' : 'Inactivo' }}" readonly>
                        <label for="ver_estado_{{ $permisouser->id }}">Estado</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center w-100">
                <button type="button" class="btn" data-bs-dismiss="modal"
                    style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Ver -->

