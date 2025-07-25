<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $eproveedor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $eproveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $eproveedor->id }}" style="color: #222944;">Editar estación de proveedores</h5>
                <a href="{{ route('estacion_proveedores') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estacion_proveedores_salvar', $eproveedor->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_proveedor') is-invalid @enderror" name="id_proveedor" id="id_proveedor{{ $eproveedor->id }}" >
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}"
                                            {{ old('id_proveedor', $eproveedor->id_proveedor) == $proveedor->id ? 'selected' : '' }}>
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_proveedor{{ $eproveedor->id }}">Proveedor</label>
                                @error('id_proveedor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_estacion') is-invalid @enderror" name="id_estacion" id="id_estacion{{ $eproveedor->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}"
                                            {{ old('id_estacion', $eproveedor->id_estacion) == $estacion->id ? 'selected' : '' }}>
                                            {{ $estacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_estacion{{ $eproveedor->id }}">Estación</label>
                                @error('id_estacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                            Editar
                        </button>
                        <a href="{{ route('estacion_proveedores') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->
