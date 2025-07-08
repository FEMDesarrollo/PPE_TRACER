<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo permiso de usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('permisos_usuarios_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select name="activo" class="form-select @error('activo') is-invalid @enderror" id="activo" required>
                            <option selected disabled>Seleccione una opción...</option>
                            <option value="1" {{ old('activo') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>No activo</option>
                        </select>
                        <label for="activo" class="ps-4">Activo</label>
                        @error('activo')
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
                        <select class="form-select @error('id_permiso') is-invalid @enderror" name="id_permiso" id="id_permiso" required>
                            <option selected disabled>Seleccione un permiso...</option>
                            @foreach($permisos as $permiso)
                                <option value="{{ $permiso->id }}" {{ old('id_permiso') == $permiso->id ? 'selected' : '' }}>{{ $permiso->permiso }}</option>
                            @endforeach
                        </select>
                        <label for="id_permiso" class="ps-4">Permiso</label>
                        @error('id_permiso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>