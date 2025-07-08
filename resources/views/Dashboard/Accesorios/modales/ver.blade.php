<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $accesorio->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $accesorio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header position-relative">
                <h5 class="modal-title text-center w-100 fw-bold" style="color: #222944;">Detalles del accesorio</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <div class="imagen-accesorio text-center mb-4">
                    @if($accesorio->imagen)
                        <img
                            src="{{ asset('storage/' . $accesorio->imagen) }}"
                            alt="Foto del accesorio"
                            class="img-accesorio"
                            data-bs-toggle="modal"
                            data-bs-target="#modalImagenGrande{{ $accesorio->id }}"
                        >
                    @else
                        <div class="no-imagen-accesorio">
                            <i class="bi bi-person-fill"></i>
                            <span>No hay foto</span>
                        </div>
                    @endif
                    <div class="mt-2">
                        <label class="form-label fw-bold">Accesorio</label>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombreAccesorio{{ $accesorio->id }}"
                                value="{{ $accesorio->nombre }}" readonly>
                            <label for="nombreAccesorio{{ $accesorio->id }}">Nombre</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="imagen{{ $accesorio->id }}"
                                value="{{ $accesorio->imagen }}" readonly>
                            <label for="imagen{{ $accesorio->id }}">Nombre de imagen</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="marca{{ $accesorio->id }}"
                                value="{{ $accesorio->marca }}" readonly>
                            <label for="marca{{ $accesorio->id }}">Marca</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="modelo{{ $accesorio->id }}"
                                value="{{ $accesorio->modelo }}" readonly>
                            <label for="modelo{{ $accesorio->id }}">Modelo</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="detalle_descripcion{{ $accesorio->id }}"
                                value="{{ $accesorio->detalle_descripcion }}" readonly>
                            <label for="detalle_descripcion{{ $accesorio->id }}">Detalle Descripción</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="equipo{{ $accesorio->id }}"
                                value="{{ $accesorio->equipo->equipo }}" readonly>
                            <label for="equipo{{ $accesorio->id }}">Nombre del Equipo</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c;">
                        Cerrar
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Fin Modal Ver -->

<!-- Modal Imagen Grande -->
@if($accesorio->imagen)
<div class="modal fade" id="modalImagenGrande{{ $accesorio->id }}" tabindex="-1" aria-labelledby="imagenLabel{{ $accesorio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="background-color: transparent; border: none; box-shadow: none;">

            <div class="modal-header border-0">
               <button type="button" class="btn-close custom-close ms-auto" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalVer{{ $accesorio->id }}" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center " >
                <img src="{{ asset('storage/' . $accesorio->imagen) }}"
                    class="img-fluid rounded modal-imagen-uniforme"
                    alt="Imagen grande del accesorio">
            </div>
        </div>
    </div>
</div>
@endif
<!-- Fin Modal Imagen Grande -->
