<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $permisouser->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $permisouser->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $permisouser->id }}" style="color: #222944;">Editar permiso de usuario</h5>
                        <a href="{{ route('permisos_usuarios') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('permisos_usuarios_salvar', $permisouser->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <input type="hidden" name="id" value="{{ $permisouser->id }}">

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_usuario') is-invalid @enderror" name="id_usuario" id="id_usuario_edit_{{ $permisouser->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($usuarios as $user)
                                        <option value="{{ $user->id }}"
                                        {{ old('id_usuario', $permisouser->id_usuario) == $user->id ? 'selected' : '' }}>
                                        {{ $user->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_usuario{{ $permisouser->id }}">Usuario</label>
                                @error('id_usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-floating">
                            <select class="form-select @error('id_permiso') is-invalid @enderror" name="id_permiso" id="id_permiso_edit_{{ $permisouser->id }}">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach($permisos as $permiso)
                                    <option value="{{ $permiso->id }}"
                                        {{ old('id_permiso', $permisouser->id_permiso) == $permiso->id ? 'selected' : '' }}>
                                        {{ $permiso->permiso}}
                                    </option>
                                @endforeach

                            </select>
                            <label for="id_permiso_edit_{{ $permisouser->id }}">Permiso</label>
                            @error('id_permiso')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 form-floating">
                            <select class="form-select @error('activo') is-invalid @enderror" name="activo" id="activo_edit_{{ $permisouser->id }}">
                                <option value="si" {{ (old('activo', $permisouser->activo) == 'si') ? 'selected' : '' }}>Si</option>
                                <option value="no" {{ (old('activo', $permisouser->activo) == 'no') ? 'selected' : '' }}>No</option>
                            </select>
                            <label for="activo_edit_{{ $permisouser->id }}">Estado</label>
                            @error('activo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Guardar</button>
                        <!-- Redirección evita reabrir modal -->
                        <a href="{{ route('permisos_usuarios') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->
