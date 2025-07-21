<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo usuario de equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('usuarios_equipos_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha_estatus" class="form-control @error('fecha_estatus') is-invalid @enderror" id="fecha_estatus" placeholder="Fecha" value="{{ old('fecha_estatus') }}">
                        <label for="fecha_estatus" class="ps-4">Fecha</label>
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="comentarios" class="form-control @error('comentarios') is-invalid @enderror" id="comentarios" placeholder="Comentarios" value="{{ old('comentarios') }}">
                        <label for="comentarios" class="ps-4">Comentarios</label>
                        @error('comentarios')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_estatus_equipo') is-invalid @enderror" name="id_estatus_equipo" id="id_estatus_equipo">
                            <option selected disabled>Seleccione un estado de estatus...</option>
                                @foreach($estatus_equipo as $estatusEquipo)
                                    <option value="{{ $estatusEquipo->id }}" {{ old('id_estatus_equipo') == $estatusEquipo->id ? 'selected' : '' }}>{{ $estatusEquipo->estado }}</option>
                                @endforeach
                        </select>
                        <label for="id_estatus_equipo" class="ps-4">Estado de estatus</label>
                        @error('id_estatus_equipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_usuario') is-invalid @enderror" name="id_usuario" id="id_usuario">
                            <option selected disabled>Seleccione un usuario...</option>
                                @foreach($usuario as $user)
                                    <option value="{{ $user->id }}" {{ old('id_usuario') == $user->id ? 'selected' : '' }}>{{ $user->nombre }}</option>
                                @endforeach
                        </select>
                        <label for="id_usuario" class="ps-4">Usuarios</label>
                        @error('id_usuario')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_equipo') is-invalid @enderror" name="id_equipo" id="id_equipo">
                            <option selected disabled>Seleccione un equipo...</option>
                                @foreach($equipo as $equip)
                                    <option value="{{ $equip->id }}" {{ old('id_equipo') == $equip->id ? 'selected' : '' }}>{{ $equip->equipo }}</option>
                                @endforeach
                        </select>
                        <label for="id_equipo" class="ps-4">Equipo</label>
                        @error('id_equipo')
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
