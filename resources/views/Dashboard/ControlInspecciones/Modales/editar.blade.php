<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $controlins->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $controlins->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $controlins->id }}" style="color: #222944;">Editar control de inspecciones</h5>
                    <a href="{{ route('control_inspecciones') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <div class="modal-body">
                <form action="{{ route('control_inspecciones_salvar', ['id' => $controlins->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $controlins->id }}">

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select @error('respuesta') is-invalid @enderror" name="respuestas" id="respuestas{{ $controlins->id }}" required>
                                        <option value="si" {{ old('respuestas', $controlins->respuestas) == 'si' ? 'selected' : '' }}>Sí</option>
                                        <option value="no" {{ old('respuestas', $controlins->respuestas) == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                    <label for="respuestas{{ $controlins->id }}">Respuesta</label>
                                    @error('respuesta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control w-100 @error('fecha') is-invalid @enderror" name="fecha" id="fecha{{ $controlins->id }}" placeholder="Fecha" value="{{ old('fecha', $controlins->fecha )}}">
                                    <label for="fecha{{ $controlins->id }}">Fecha</label>
                                    @error('fecha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="file" class="form-control w-100" name="imagen1" id="floatingimagen" accept=".jpg,.png,.bmp">
                                <input type="hidden" name="imagen2" value="{{ $controlins->imagen }}">
                                <label for="floatingimagen">imagen</label>
                                <div id="imagenHelp" class="form-text">Suba una imagen para el control de inspecciones ( <i>Formatos</i>: jpg/png/bmp)</div>
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100 @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion{{ $controlins->id }}" placeholder="Descripcion" value="{{ old('descripcion', $controlins->descripcion )}}">
                                    <label for="descripcion{{ $controlins->id }}">Descripcion</label>
                                    @error('descripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario" id="id_usuario{{ $controlins->id }}">
                                        @foreach($usuarios as $user)
                                            <option value="{{ $user->id }}"
                                            {{ old('id_usuario', $controlins->id_usuario) == $user->id ? 'selected' : '' }}>
                                                {{ $user->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario{{ $controlins->id }}">Usuarios</label>
                                    @error('id_usuario')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_gestion_inspeccion" id="id_gestion_inspecciones{{ $controlins->id }}">
                                        <option selected disabled>Seleccione una gestion de inspecciones...</option>
                                        @foreach($gestion_inspecciones as $gestionInspeccion)
                                                <option value="{{ $gestionInspeccion->id }}" {{ old('id_gestion_inspeccion', $controlins->id_gestion_inspeccion) == $gestionInspeccion->id ? 'selected' : '' }}>
                                                {{ $gestionInspeccion->observaciones }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_gestion_inspecciones{{ $controlins->id }}">Gestion de inspecciones</label>
                                    @error('id_gestion_inspeccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                            <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                            <a href="{{ route('control_inspecciones') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Fin de Editar -->
<!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $controlins->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $controlins->id }}'));
            modal.show();
        });
    </script>
@endif
