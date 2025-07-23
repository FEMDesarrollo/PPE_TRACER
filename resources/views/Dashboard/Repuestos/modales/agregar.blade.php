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
                        <input type="number" step="0.01" name="costo" class="form-control @error('costo') is-invalid @enderror" id="costo" placeholder="Costo" value="{{ old('costo') }}">
                        <label for="costo" class="ps-4">Costo</label>
                        @error('costo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="date" name="fecha_disponible" class="form-control @error('fecha_disponible') is-invalid @enderror" id="fecha_disponible" placeholder="Fecha disponible" value="{{ old('fecha_disponible') }}">
                        <label for="fecha_disponible" class="ps-4">Fecha disponible</label>
                        @error('fecha_disponible')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-floating">
                            <select name="id_prov_servicio" class="form-select @error('id_prov_servicio') is-invalid @enderror" id="id_prov_servicio" required>
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach($proveedorServicios as $proveedor_s)
                                    <option value="{{ $proveedor_s->id }}" {{ old('id_prov_servicio') == $proveedor_s->id ? 'selected' : '' }}>{{ $proveedor_s->id }}</option>
                                @endforeach
                            </select>
                            <label for="id_prov_servicio">Proveedor Servicio</label>
                            @error('id_prov_servicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-floating">
                            <select name="id_accesorio" class="form-select @error('id_accesorio') is-invalid @enderror" id="id_accesorio">
                                <option selected disabled>Selecciona una opción...</option>
                                @foreach($accesorios as $accesorio)
                                    <option value="{{ $accesorio->id }}" {{ old('id_accesorio') == $accesorio->id ? 'selected' : '' }}>{{ $accesorio->nombre }}</option>
                                @endforeach
                            </select>
                            <label for="id_accesorio" class="ps-4">Accesorio</label>
                            @error('id_accesorio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <!-- Redirección evita reabrir modal -->
                        <a href="{{ route('repuestos') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin de Añadir -->



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



