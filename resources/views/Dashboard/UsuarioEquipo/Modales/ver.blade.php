<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $userequipo->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $userequipo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title w-100 text-center fw-bold" id="modalVerLabel{{ $userequipo->id }}" style="color: #222944;">Detalle usuario de equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_fecha{{ $userequipo->id }}" value="{{ $userequipo->fecha_estatus }}" readonly>
                            <label for="ver_fecha{{ $userequipo->id }}">Fecha</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_comentarios{{ $userequipo->id }}" value="{{ $userequipo->comentarios }}" readonly>
                            <label for="ver_comentarios{{ $userequipo->id }}">Comentarios</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_estatus_equipo{{ $userequipo->id }}" value="{{ $userequipo->estatus_equipos->estado ?? 'Sin estatus de equipo' }}" readonly>
                            <label for="ver_id_estatus_equipo{{ $userequipo->id }}">Etatus de equipo</label>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_usuario{{ $userequipo->id }}" value="{{ $userequipo->usuarios->nombre ?? 'Sin usuario' }}" readonly>
                            <label for="ver_id_usuario{{ $userequipo->id }}">Usuario</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_equipo{{ $userequipo->id }}" value="{{ $userequipo->equipos->equipo ?? 'Sin equipo' }}" readonly>
                            <label for="ver_id_equipo{{ $userequipo->id }}">Equipo</label>
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

