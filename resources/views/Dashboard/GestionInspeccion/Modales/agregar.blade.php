<!-- Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nueva Observación</h5>
                    <a href="{{ route('gestion_inspecciones') }}" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gestion_inspecciones_registrar') }}" method="POST" class="row g-3">
                        <input type="hidden" name="modal" value="añadir">
                    @csrf
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" placeholder="Observaciones" value="{{ old('observaciones') }}">
                            <label for="observaciones" class="ps-4">Observaciones</label>
                            @error('observaciones')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                Agregar
                            </button>
                            <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('gestion_inspecciones') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
