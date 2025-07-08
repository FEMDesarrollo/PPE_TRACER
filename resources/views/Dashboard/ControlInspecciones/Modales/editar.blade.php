<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $controlins->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $controlins->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $controlins->id }}" style="color: #222944;">Control de inspecciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('control_inspecciones_salvar', ['id' => $controlins->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

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
                                    <input type="date" class="form-control w-100" name="fecha" id="fecha{{ $controlins->id }}" placeholder="Fecha" value="{{ $controlins->fecha }}">
                                    <label for="fecha{{ $controlins->id }}">Fecha</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="file" class="form-control w-100" name="imagen1" id="floatingimagen" accept=".jpg,.png,.bmp">
                                <input type="hidden" name="imagen2" value="{{ $controlins->imagen }}">
                                <label for="floatingimagen">imagen</label>
                                <div id="imagenHelp" class="form-text">Suba una imagen para el control de inspecciones ( <i>Formatos</i>: jpg/png/bmp)</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="descripcion" id="descripcion{{ $controlins->id }}" placeholder="Descripcion" value="{{ $controlins->descripcion }}">
                                    <label for="descripcion{{ $controlins->id }}">Descripcion</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario" id="id_usuario{{ $controlins->id }}">
                                        @foreach($usuarios as $user)
                                            <option value="{{ $user->id }}" {{ $controlins->id_usuario == $user->id ? 'selected' : '' }}>
                                                {{ $user->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario{{ $controlins->id }}">Nombre de usuario</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_gestion_inspeccion" id="id_gestion_inspecciones{{ $controlins->id }}">
                                        @foreach($gestion_inspecciones as $gestionInspeccion)
                                            <option value="{{ $gestionInspeccion->id }}" {{ $controlins->id_gestion_inspecciones == $gestionInspeccion->id ? 'selected' : '' }}>
                                                {{ $gestionInspeccion->observaciones }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_gestion_inspecciones{{ $controlins->id }}">Observaciones</label>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                            <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Fin de Editar -->
