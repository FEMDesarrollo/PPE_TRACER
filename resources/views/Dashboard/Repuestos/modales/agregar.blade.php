    <!--Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Repuesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('repuestos_registrar') }}" method="POST" class="row g-3">
                        {{ csrf_field() }}

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="number" step="0.01" name="costo" class="form-control" id="costo" placeholder="Costo">
                            <label for="costo" class="ps-4">Costo</label>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="date" name="fecha_disponible" class="form-control" id="fecha_disponible" placeholder="Fecha disponible">
                            <label for="fecha_disponible" class="ps-4">Fecha disponible</label>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_prov_servicio" class="form-select" id="id_prov_servicio" required>
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($proveedorServicios as $proveedor_s)
                                        <option value="{{ $proveedor_s->id }}">{{ $proveedor_s->id }}</option>
                                    @endforeach
                                </select>
                                <label for="id_prov_servicio">Proveedor Servicio</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_accesorio" class="form-select" id="id_accesorio">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach($accesorios as $accesorio)
                                        <option value="{{ $accesorio->id }}">{{ $accesorio->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="id_accesorio" class="ps-4">Accesorio</label>
                            </div>
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