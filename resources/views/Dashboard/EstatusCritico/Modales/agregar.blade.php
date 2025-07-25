<!-- Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Estatus Crítico</h5>
                <a href="{{ route('estatus_critico') }}" class="btn-close" aria-label="Close"></a>
            </div>
                <div class="modal-body">
                    <form action="{{ route('estatus_critico_registrar') }}" method="POST" class="row g-3">
                        <input type="hidden" name="modal" value="añadir">
                        @csrf
                        <div class="col-12 col-sm-6 col-md-6 form-floating">

                            <input type="text" name="estatus" class="form-control @error('estatus') is-invalid @enderror" id="estatus" placeholder="Estatus" value="{{ old('estatus') }}">
                            <label for="estatus" class="ps-4">Estatus Crítico</label>

                            @error('estatus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                Guardar
                            </button>
                            <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('estatus_critico') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--Fin de Añadir -->
