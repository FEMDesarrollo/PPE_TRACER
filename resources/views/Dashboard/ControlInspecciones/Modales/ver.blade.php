<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $controlins->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $controlins->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header position-relative">
                <h5 class="modal-title text-center w-100 fw-bold" style="color: #222944;">Detalles del control de inspecciones</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">

                <div class="row justify-content-center mb-4">
                    <div class="col-auto text-center">
                        @if($controlins->imagen)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalimagenGrande{{ $controlins->id }}">
                                <img
                                    src="{{ asset('storage/' . $controlins->imagen) }}"
                                    alt="imagen de control de inspeccion"
                                    class="img-thumbnail rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;"
                                >
                            </a>
                        @else
                            <div class="text-muted bg-light p-3 rounded-circle d-inline-flex flex-column align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                                <span>No hay imagen</span>
                            </div>
                        @endif
                        <div class="mt-2">
                            <label class="form-label fw-bold">imagen de Control de inspección</label>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_respuestas{{ $controlins->id }}" value="{{ $controlins->respuestas }}" readonly>
                            <label for="ver_respuestas{{ $controlins->id }}">Respuestas</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_fecha{{ $controlins->id }}" value="{{ $controlins->fecha }}" readonly>
                            <label for="ver_fecha{{ $controlins->id }}">Fecha</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_descripcion{{ $controlins->id }}" value="{{ $controlins->descripcion }}" readonly>
                            <label for="ver_descripcion{{ $controlins->id }}">Descripcion</label>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_usuario{{ $controlins->id }}" value="{{ $controlins->usuarios->nombre ?? 'Sin usuario' }}" readonly>
                            <label for="ver_id_usuario{{ $controlins->id }}">Usuario</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_gestion_inspeccion{{ $controlins->id }}" value="{{ $controlins->gestion_inspeccion->observaciones ?? 'Sin gestion de inspeccion' }}" readonly>
                            <label for="ver_id_gestion_inspeccion{{ $controlins->id }}">Gestion de inspeccion</label>
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

<!-- Modal imagen Grande -->
@if($controlins->imagen)
<div class="modal fade" id="modalimagenGrande{{ $controlins->id }}" tabindex="-1" aria-labelledby="imagenLabel{{ $controlins->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="background-color: transparent; border: none; box-shadow: none;">
            <div class="modal-header border-0">
                <button type="button" class="btn-close custom-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $controlins->imagen) }}"
                     class="img-fluid rounded modal-imagen-uniforme"
                     alt="imagen grande del control de inspecciones">
            </div>
        </div>
    </div>
</div>
@endif
<!-- Fin Modal imagen Grande -->
