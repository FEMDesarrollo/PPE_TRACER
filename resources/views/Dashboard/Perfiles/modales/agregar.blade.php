<!-- Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Perfil</h5>
                <a href="{{ route('perfiles') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('perfiles_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="modal" value="añadir">
                {{ csrf_field() }}
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombrePerfil" placeholder="Nombre"  value="{{ old('nombre') }}">
                        <label for="nombrePerfil" class="ps-4">Nombre</label>
                        @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                            Agregar
                        </button>
                        <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('perfiles') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Añadir -->
