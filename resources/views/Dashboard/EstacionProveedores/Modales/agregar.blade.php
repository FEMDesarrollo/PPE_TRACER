<!-- Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nueva estación de proveedores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('estacion_proveedores_registrar') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6 form-floating">
                        <select name="id_proveedor" class="form-select" id="id_proveedor" required>
                            <option value="">Seleccione un proveedor</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="id_proveedor" class="ps-4">Proveedor</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <select name="id_estacion" class="form-select" id="id_estacion" required>
                            <option value="">Seleccione una estación</option>
                            @foreach($estaciones as $estacion)
                                <option value="{{ $estacion->id }}">{{ $estacion->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="id_estacion" class="ps-4">Estación</label>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                            Agregar
                        </button>
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>