<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo detalle de equipo</h5>
                <a href="{{ route('detalles_equipos') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">

                <form action="{{ route('detalles_equipos_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="modal" value="añadir">
                    {{ csrf_field() }}


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" id="modelo" placeholder="Modelo" value="{{ old('modelo') }}">
                        <label for="modelo" class="ps-4">Modelo</label>
                        @error('modelo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="no_serie" class="form-control @error('no_serie') is-invalid @enderror" id="no_serie" placeholder="Numero de serie" value="{{ old('no_serie') }}">
                        <label for="no_serie" class="ps-4">Numero de serie</label>
                        @error('no_serie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="talla" class="form-control @error('talla') is-invalid @enderror" id="talla" placeholder="Talla" value="{{ old('talla') }}">
                        <label for="talla" class="ps-4">Talla</label>
                        @error('talla')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="number" name="piezas" class="form-control @error('piezas') is-invalid @enderror" id="piezas" placeholder="Piezas" value="{{ old('piezas') }}">
                        <label for="piezas" class="ps-4">Piezas</label>
                        @error('piezas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha_fabricacion" class="form-control @error('fecha_fabricacion') is-invalid @enderror" id="fecha_fabricacion" placeholder="Fecha de fabricacion" value="{{ old('fecha_fabricacion') }}">
                        <label for="fecha_fabricacion" class="ps-4">Fecha de fabricacion</label>
                        @error('fecha_fabricacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_usuario_equipo') is-invalid @enderror" name="id_usuario_equipo" id="id_usuario_equipo">
                            <option selected disabled>Seleccione un usuario de equipo...</option>
                                @foreach($usuarios_equipos as $userequipo)
                                    <option value="{{ $userequipo->id }}" {{ old('id_usuario_equipo') == $userequipo->id ? 'selected' : '' }}>{{ $userequipo->id }}</option>
                                @endforeach
                        </select>
                        <label for="id_usuario_equipo" class="ps-4">Id de Usuario equipos</label>
                        @error('id_usuario_equipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <a href="{{ route('detalles_equipos') }}" class="btn"
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
