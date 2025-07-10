<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo control de asignaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('control_asignaciones_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    {{ csrf_field() }}


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" id="observaciones" placeholder="Observaciones" value="{{ old('observaciones') }}" required>
                        <label for="observaciones" class="ps-4">Observaciones</label>
                        @error('observaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha_asignacion" class="form-control @error('fecha_asignacion') is-invalid @enderror" id="fecha_asignacion" placeholder="Fecha signacion" value="{{ old('fecha_asignacion') }}" required>
                        <label for="fecha_asignacion" class="ps-4">Fecha de asignacion</label>
                        @error('fecha_asignacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha_devolucion" class="form-control @error('fecha_devolucion') is-invalid @enderror" id="fecha_devolucion" placeholder="Fecha de devolucion" value="{{ old('fecha_devolucion') }}" required>
                        <label for="fecha_devolucion" class="ps-4">Fecha de devolucion</label>
                        @error('fecha_devolucion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_usuario_equipo') is-invalid @enderror" name="id_usuario_equipo" id="id_usuario_equipo" required>
                            <option selected disabled>Seleccione un usuario de equipo...</option>
                                @foreach($usuarios_equipos as $userequipo)
                                    <option value="{{ $userequipo->id }}" {{ old('id_usuario_equipo') == $userequipo->id ? 'selected' : '' }}>{{ $userequipo->fecha_estatus }}</option>
                                @endforeach
                        </select>
                        <label for="id_usuario_equipo" class="ps-4">Fecha de estatus</label>
                        @error('id_usuario_equipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_estatus_critico') is-invalid @enderror" name="id_estatus_critico" id="id_estatus_critico" required>
                            <option selected disabled>Seleccione un estatus critico...</option>
                                @foreach($estatus_critico as $estado)
                                    <option value="{{ $estado->id }}" {{ old('id_estatus_critico') == $estado->id ? 'selected' : '' }}>{{ $estado->estatus }}</option>
                                @endforeach
                        </select>
                        <label for="id_estatus_critico" class="ps-4">Estatus critico</label>
                        @error('id_estatus_critico')
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
