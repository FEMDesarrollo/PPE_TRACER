 <!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $eproveedor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $eproveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $eproveedor->id }}" style="color: #222944;">Editar estación de proveedores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('estacion_proveedores_salvar', $eproveedor->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="id_proveedor" class="form-select" id="id_proveedor{{ $eproveedor->id }}" required>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}" {{ $proveedor->id == $eproveedor->id_proveedor ? 'selected' : '' }}>
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_proveedor{{ $eproveedor->id }}">Proveedor</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="id_estacion" class="form-select" id="id_estacion{{ $eproveedor->id }}" required>
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}" {{ $estacion->id == $eproveedor->id_estacion ? 'selected' : '' }}>
                                            {{ $estacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_estacion{{ $eproveedor->id }}">Estación</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                            Editar 
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