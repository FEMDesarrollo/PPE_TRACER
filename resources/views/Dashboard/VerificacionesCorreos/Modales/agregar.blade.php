<!--Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nueva verificación de correo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('verificacion_correo_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <!-- Código de verificación -->
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="codigo_verificacion" class="form-control @error('codigo_verificacion') is-invalid @enderror"
                            id="codigo_verificacion" placeholder="Código de verificación" value="{{ old('codigo_verificacion') }}" required>
                        <label for="codigo_verificacion" class="ps-4">Código de verificación</label>
                        @error('codigo_verificacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
                            id="fecha" placeholder="Fecha" value="{{ old('fecha') }}" required>
                        <label for="fecha" class="ps-4">Fecha</label>
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Usuario -->
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_usuario') is-invalid @enderror" name="id_usuario" id="id_usuario" required>
                            <option selected disabled>Seleccione un usuario...</option>
                            @foreach($usuarios as $user)
                                <option value="{{ $user->id }}" {{ old('id_usuario') == $user->id ? 'selected' : '' }}>{{ $user->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="id_usuario" class="ps-4">Usuario</label>
                        @error('id_usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn"
                            style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin de Añadir -->

<!-- Redirección de formulario si hay errores en las validaciones -->
@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var myModal = new bootstrap.Modal(document.getElementById('modalAñadir'));
            myModal.show();
        });
    </script>
@endif
<!-- Fin de redirección de formulario si hay errores -->
