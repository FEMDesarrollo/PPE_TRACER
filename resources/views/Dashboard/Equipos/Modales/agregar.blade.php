<!-- Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo equipo</h5>
                <a href="{{ route('equipos') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('equipos_registrar') }}" method="POST" class="row g-3">
                    <input type="hidden" name="modal" value="añadir">
                    @csrf
                    <div class="col-12 form-floating col-md-6">
                        <input type="text" name="equipo" class="form-control @error('equipo') is-invalid @enderror" id="equipo" placeholder="Equipo" value="{{ old('equipo') }}">
                        <label for="equipo" class="ps-4">Equipo</label>
                        @error('equipo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                            Guardar
                        </button>
                        <a href="{{ route('equipos') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin de Añadir -->

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
