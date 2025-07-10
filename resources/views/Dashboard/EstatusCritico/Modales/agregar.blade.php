<!-- Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Estatus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('estatus_critico_registrar') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="estatus" class="form-control @error('estatus') is-invalid @enderror" id="estatus" placeholder="Estatus" value="{{ old('estatus') }}" required>
                            <label for="estatus" class="ps-4">Estatus</label>
                            @error('estatus')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                Agregar
                            </button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <!--Redirección de formulario si hay errores en las validaciones -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById('modalAñadir'));
                myModal.show();
            });
        </script>
    @endif
    <!--Fin de redirección de formulario si hay errores en las validaciones -->
