<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo detalle de estatus</h5>
                <a href="{{ route('detalles_estatus') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">

                <form action="{{ route('detalles_estatus_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="total_respuesta" class="form-control @error('total_respuesta') is-invalid @enderror" id="total_respuesta" placeholder="Total de respuesta" value="{{ old('total_respuesta') }}" >
                        <label for="total_respuesta" class="ps-4">Total de respuesta</label>
                        @error('total_respuesta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_estatus') is-invalid @enderror" name="id_estatus" id="id_estatus" >
                            <option selected disabled>Seleccione un estatus...</option>
                                @foreach($estatus_critico as $estado)
                                    <option value="{{ $estado->id }}" {{ old('id_estatus') == $estado->id ? 'selected' : '' }}>{{ $estado->estatus }}</option>
                                @endforeach
                        </select>
                        <label for="id_estatus" class="ps-4">Estatus</label>
                        @error('id_estatus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_usuario') is-invalid @enderror" name="id_usuario" id="id_usuario" >
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

                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
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
