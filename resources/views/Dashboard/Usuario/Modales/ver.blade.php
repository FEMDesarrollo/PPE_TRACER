<!-- Modal Ver -->
<div class="modal fade" id="modalVer{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalVerLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Detalle usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-center mb-4">
                    <div class="col-auto text-center">
                        @if($user->foto)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalfotoGrande{{ $user->id }}">
                                <img
                                    src="{{ asset('storage/' . $user->foto) }}"
                                    alt="Foto del usuario"
                                    class="img-thumbnail rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover;"
                                >
                            </a>
                        @else
                            <div class="text-muted bg-light p-3 rounded-circle d-inline-flex flex-column align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                                <span>No hay foto</span>
                            </div>
                        @endif
                        <div class="mt-2">
                            <label class="form-label fw-bold">Foto de perfil</label>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_nombreUsuario{{ $user->id }}" value="{{ $user->nombre }}" readonly>
                            <label for="ver_nombreUsuario{{ $user->id }}">Nombre</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_app{{ $user->id }}" value="{{ $user->app }}" readonly>
                            <label for="ver_app{{ $user->id }}">Apellido paterno</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_apm{{ $user->id }}" value="{{ $user->apm }}" readonly>
                            <label for="ver_apm{{ $user->id }}">Apellido materno</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_telefono{{ $user->id }}" value="{{ $user->telefono }}" readonly>
                            <label for="ver_telefono{{ $user->id }}">Teléfono</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_correo{{ $user->id }}" value="{{ $user->correo }}" readonly>
                            <label for="ver_correo{{ $user->id }}">Correo</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_password{{ $user->id }}" value="{{ $user->password }}" readonly>
                            <label for="ver_password{{ $user->id }}">Contraseña</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_estacion{{ $user->id }}" value="{{ $user->estacion->nombre ?? 'Sin estación' }}" readonly>
                            <label for="ver_id_estacion{{ $user->id }}">Estación</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_subestacion{{ $user->id }}" value="{{ $user->subestacion->nombre ?? 'Sin sub-estación' }}" readonly>
                            <label for="ver_id_subestacion{{ $user->id }}">Sub estación</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="ver_id_perfil{{ $user->id }}" value="{{ $user->perfil->nombre ?? 'Sin perfil' }}" readonly>
                            <label for="ver_id_perfil{{ $user->id }}">Perfil</label>
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

<!-- Modal foto Grande -->
@if($user->foto)
<div class="modal fade" id="modalfotoGrande{{ $user->id }}" tabindex="-1" aria-labelledby="fotoLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="background-color: transparent; border: none; box-shadow: none;">
             <div class="modal-header border-0">
               <button type="button" class="btn-close custom-close ms-auto" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalVer{{ $user->id }}" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $user->foto) }}"
                     class="img-fluid rounded modal-imagen-uniforme"
                     alt="foto grande del user">
            </div>
        </div>
    </div>
</div>
@endif
<!-- Fin Modal foto Grande -->
