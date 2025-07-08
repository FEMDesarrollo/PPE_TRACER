<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $verico->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $verico->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $verico->id }}" style="color: #222944;">Detalle de verificación de correo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('verificacion_correo_salvar', ['id' => $verico->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="codigo_verificacion" id="codigo_verificacion{{ $verico->id }}" placeholder="Codigo de verificacion" value="{{ $verico->codigo_verificacion }}">
                                    <label for="codigo_verificacion{{ $verico->id }}">Código de verificación</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control w-100" name="fecha" id="fecha{{ $verico->id }}" placeholder="Fecha" value="{{ $verico->fecha }}">
                                    <label for="fecha{{ $verico->id }}">Fecha</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario" id="id_usuario{{ $verico->id }}">
                                        @foreach($usuarios as $user)
                                            <option value="{{ $user->id }}" {{ $verico->id_usuario == $user->id ? 'selected' : '' }}>
                                                {{ $user->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario{{ $verico->id }}">Usuario</label>
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
