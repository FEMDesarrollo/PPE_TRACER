<!--Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Permiso</h5>
                <a href="{{ route('permisos') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('permisos_registrar') }}" method="POST" class="row g-3">
                    <input type="hidden" name="modal" value="añadir">
                    {{ csrf_field() }}
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="permiso" class="form-control @error('permiso') is-invalid @enderror" id="permiso" placeholder="Permiso" value="{{ old('permiso') }}">
                        <label for="permiso" class="ps-4">Permiso</label>
                        @error('permiso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text"  name="url" class="form-control @error('url') is-invalid @enderror" id="url" placeholder="Url" value="{{ old('url') }}">
                        <label for="url" class="ps-4">URL</label>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" data-bs-dismiss="modal"
                            style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                       <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('permisos') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin de Añadir -->
