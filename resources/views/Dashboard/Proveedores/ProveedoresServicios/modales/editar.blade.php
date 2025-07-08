<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $proveedor_s->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $proveedor_s->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $proveedor_s->id }}" style="color: #222944;">Editar Proveedor Servicios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('proveedor_servicios_salvar', ['id' => $proveedor_s->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_servicio" id="id_servicio{{ $proveedor_s->id }}">
                                    @foreach($servicios as $servis)
                                        <option value="{{ $servis->id }}" {{ $proveedor_s->id_servicio == $servis->id ? 'selected' : '' }}>
                                            {{ $servis->servicio }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_servicio{{ $proveedor_s->id }}">Servicio</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_proveedor" id="id_proveedor{{ $proveedor_s->id }}">
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}" {{ $proveedor_s->id_proveedor == $proveedor->id ? 'selected' : '' }}>
                                            {{ $proveedor->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_proveedor{{ $proveedor_s->id }}">Proveedor</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->