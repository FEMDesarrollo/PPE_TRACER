<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $detallequi->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $detallequi->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title fw-bold text-center" id="modalVerLabel{{ $detallequi->id }}" style="color: #222944;">Detalle de equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_modelo{{ $detallequi->id }}" value="{{ $detallequi->modelo }}" readonly>
                            <label for="ver_modelo{{ $detallequi->id }}">Modelo</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_no_serie{{ $detallequi->id }}" value="{{ $detallequi->no_serie }}" readonly>
                            <label for="ver_no_serie{{ $detallequi->id }}">Numero de serie</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_talla{{ $detallequi->id }}" value="{{ $detallequi->talla }}" readonly>
                            <label for="ver_talla{{ $detallequi->id }}">Talla</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_piezas{{ $detallequi->id }}" value="{{ $detallequi->piezas }}" readonly>
                            <label for="ver_piezas{{ $detallequi->id }}">Piezas</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_fecha_fabricacion{{ $detallequi->id }}" value="{{ $detallequi->fecha_fabricacion }}" readonly>
                            <label for="ver_fecha_fabricacion{{ $detallequi->id }}">Fecha de fabricacion</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_usuario_equipo{{ $detallequi->id }}" value="{{ $detallequi->usuarios_equipos->id ?? 'Sin fecha de estatus' }}" readonly>
                            <label for="ver_id_usuario_equipo{{ $detallequi->id }}">Id de Usuario equipos</label>
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

