<!-- Modal Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalAñadirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalAñadirLabel" style="color: #222944;">Agregar Nuevo Estado</h5>
                <a href="{{ route('estatus_equipos') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estatus_equipos_registrar') }}" method="POST" class="row g-3">
                    <input type="hidden" name="modal" value="añadir">
                    @csrf
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="estado" class="form-control  @error('estado') is-invalid @enderror" id="estado" placeholder="Estado" value="{{ old('estado') }}">
                        <label for="estado" class="ps-4">Estado</label>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944;">Agregar</button>
                        <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('estatus_equipos') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
