<!--Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nueva subestación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subestaciones_registrar') }}" method="POST" class="row g-3">
                        {{ csrf_field() }}

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="nombre" class="form-control" id="nombresestacion" placeholder="Nombre">
                            <label for="nombresestacion" class="ps-4">Nombre</label>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Dirección">
                            <label for="direccion" class="ps-4">Dirección</label>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text"  name="telefono" class="form-control" id="telefono" placeholder="Telefono">
                            <label for="telefono" class="ps-4">Teléfono</label>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <select class="form-select" name="id_estacion" id="id_estacion">
                                <option value="">Seleccione una estación</option>
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}">{{ $estacion->nombre }}</option>
                                    @endforeach
                            </select>
                            <label for="id_estacion" class="ps-4">Estación</label>
                        </div>

                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" data-bs-dismiss="modal"
                                style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--Fin de Añadir -->
