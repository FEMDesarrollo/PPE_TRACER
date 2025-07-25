<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $verico->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $verico->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $verico->id }}" style="color: #222944;">
                    Editar verificación de correo
                </h5>
                <a href="{{ route('verificacion_correo') }}" class="btn-close" aria-label="Close"></a>
            </div>

            <form action="{{ route('verificacion_correo_salvar', ['id' => $verico->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $verico->id }}">
                <input type="hidden" name="modal" value="editar">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control w-100 @error('codigo_verificacion') is-invalid @enderror"
                                       name="codigo_verificacion" id="codigo_verificacion{{ $verico->id }}"
                                       placeholder="Código de verificación"
                                       value="{{ old('codigo_verificacion', $verico->codigo_verificacion) }}">
                                <label for="codigo_verificacion{{ $verico->id }}">Código de verificación</label>
                                @error('codigo_verificacion')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control w-100"
                                       name="fecha" id="fecha{{ $verico->id }}"
                                       placeholder="Fecha"
                                       value="{{ old('fecha', $verico->fecha) }}">
                                <label for="fecha{{ $verico->id }}">Fecha</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_usuario') is-invalid @enderror"
                                        name="id_usuario" id="id_usuario{{ $verico->id }}">
                                    @foreach($usuarios as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('id_usuario', $verico->id_usuario) == $user->id ? 'selected' : '' }}>
                                            {{ $user->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_usuario{{ $verico->id }}">Usuario</label>
                                @error('id_usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center w-100">
                    <button type="submit" class="btn"
                    style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                    <!-- Redirección evita reabrir modal -->
                    <a href="{{ route('verificacion_correo') }}" class="btn"
                    style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin de Editar -->
