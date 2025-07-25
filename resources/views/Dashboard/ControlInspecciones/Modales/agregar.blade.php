<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo control de inspecciones</h5>
                <a href="{{ route('control_inspecciones') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('control_inspecciones_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="modal" value="añadir">
                    {{ csrf_field() }}

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select name="respuestas" class="form-select @error('respuestas') is-invalid @enderror" id="respuestas">
                            <option selected disabled>Seleccione una opción...</option>
                            <option value="si" {{ old('respuestas') == 'si' ? 'selected' : '' }}>Sí</option>
                            <option value="no" {{ old('respuestas') == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                        <label for="respuestas" class="ps-4">Respuestas</label>
                        @error('respuestas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" id="fecha" placeholder="Fecha" value="{{ old('fecha') }}">
                        <label for="fecha" class="ps-4">Fecha</label>
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror" id="imagen" accept=".jpg,.png,.bmp">
                        <label for="imagen" class="ps-4">imagen</label>
                        <div id="imagenHelp" class="form-text">Suba una imagen para el control de inspecciones (<i>Formatos</i>: jpg/png/bmp)</div>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" placeholder="Descripcion" value="{{ old('descripcion') }}">
                        <label for="descripcion" class="ps-4">Descripción</label>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_usuario') is-invalid @enderror" name="id_usuario" id="id_usuario" required>
                            <option selected disabled>Seleccione un usuario...</option>
                                @foreach($usuarios as $user)
                                    <option value="{{ $user->id }}" {{ old('id_usuario') == $user->id ? 'selected' : '' }}>{{ $user->nombre }}</option>
                                @endforeach
                        </select>
                        <label for="id_usuario" class="ps-4">Usuarios</label>
                        @error('id_usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_gestion_inspeccion') is-invalid @enderror" name="id_gestion_inspeccion" id="id_gestion_inspeccion" required>
                            <option selected disabled>Seleccione una gestion de inspecciones...</option>
                                @foreach($gestion_inspecciones as $gestionin)
                                    <option value="{{ $gestionin->id }}" {{ old('id_gestion_inspeccion') == $gestionin->id ? 'selected' : '' }}>{{ $gestionin->observaciones }}</option>
                                @endforeach
                        </select>
                        <label for="id_gestion_inspeccion" class="ps-4">Gestion de inspecciones</label>
                        @error('id_gestion_inspeccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Guardar</button>
                        <a href="{{ route('control_inspecciones') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>

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
