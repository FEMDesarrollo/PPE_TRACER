<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $controlasi->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $controlasi->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalVerLabel{{ $controlasi->id }}" style="color: #222944;">Detalles del control de asignaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_observaciones{{ $controlasi->id }}" value="{{ $controlasi->observaciones }}" readonly>
                            <label for="ver_observaciones{{ $controlasi->id }}">Observaciones</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_fecha_asignacion{{ $controlasi->id }}" value="{{ $controlasi->fecha_asignacion }}" readonly>
                            <label for="ver_fecha_asignacion{{ $controlasi->id }}">Fecha de asignacion</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_fecha_devolucion{{ $controlasi->id }}" value="{{ $controlasi->fecha_devolucion }}" readonly>
                            <label for="ver_fecha_devolucion{{ $controlasi->id }}">Fecha de devolucion</label>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_usuario_equipo{{ $controlasi->id }}" value="{{ $controlasi->usuarioEquipo->fecha_estatus ?? 'Sin usuarios de equipo' }}" readonly>
                            <label for="ver_id_usuario_equipo{{ $controlasi->id }}">Usuario</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_estatus_critico{{ $controlasi->id }}" value="{{ $controlasi->estatusCritico->estatus ?? 'Sin estatus' }}" readonly>
                            <label for="ver_id_estatus_critico{{ $controlasi->id }}">Estatus critico</label>
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

