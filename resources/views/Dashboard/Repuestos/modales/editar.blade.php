<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $repuesto->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $repuesto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $repuesto->id }}" style="color: #222944;">Editar Repuesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('repuestos_salvar', ['id' => $repuesto->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id" value="{{ $repuesto->id }}">


                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control w-100 @error('costo') is-invalid @enderror" name="costo" id="costo{{ $repuesto->id }}" placeholder="Costo" value="{{ old('costo', $repuesto->costo )}}">
                                <label for="costo{{ $repuesto->id }}">Costo</label>
                                @error('costo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control w-100 @error('fecha_disponible') is-invalid @enderror" name="fecha_disponible" id="fecha_disponible{{ $repuesto->id }}" placeholder="Fecha disponible" value="{{  old('fecha_disponible',$repuesto->fecha_disponible )}}">
                                <label for="fecha_disponible{{ $repuesto->id }}">Fecha disponible</label>
                                @error('fecha_disponible')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_prov_servicio" id="id_prov_servicio{{ $repuesto->id }}">
                                    @foreach($proveedorServicios as $proveedor_s)
                                        <option value="{{ $proveedor_s->id }}" {{ $repuesto->id_prov_servicio == $proveedor_s->id ? 'selected' : '' }}>
                                            {{ $proveedor_s->id }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_prov_servicio{{ $repuesto->id }}">Proveedor Servicio</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_accesorio" id="id_accesorio{{ $repuesto->id }}">
                                    @foreach($accesorios as $accesorio)
                                        <option value="{{ $accesorio->id }}" {{ $repuesto->id_accesorio == $accesorio->id ? 'selected' : '' }}>
                                            {{ $accesorio->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_accesorio{{ $repuesto->id }}">Accesorio</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
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
<!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $repuesto->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $repuesto->id }}'));
            modal.show();
        });
    </script>
@endif
