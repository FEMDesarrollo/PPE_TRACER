    <!--Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Equipo</h5>
                        <a href="{{ route('proveedor_servicios') }}" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('proveedor_servicios_registrar') }}" method="POST" class="row g-3">
                        <input type="hidden" name="modal" value="añadir">
                        {{ csrf_field() }}
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_servicio" class="form-select @error('id_servicio') is-invalid @enderror" id="id_servicio" >
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($servicios as $servis)
                                        <option value="{{ $servis->id }}">{{ $servis->servicio }}</option>
                                    @endforeach
                                </select>
                                <label for="id_servicio">Servicio</label>
                                @error('id_servicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_proveedor" class="form-select @error('id_proveedor') is-invalid @enderror" id="id_proveedor">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="id_proveedor" class="ps-4">Proveedor</label>
                                 @error('id_proveedor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" data-bs-dismiss="modal"
                                style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                            <!-- Redirección evita reabrir modal -->
                                <a href="{{ route('proveedor_servicios') }}" class="btn"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Fin de Añadir -->
