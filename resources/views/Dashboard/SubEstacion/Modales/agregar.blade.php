<!--Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nueva subestación</h5>
                <a href="{{ route('subestaciones') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('subestaciones_registrar') }}" method="POST" class="row g-3">
                    <input type="hidden" name="modal" value="añadir">
                    @csrf
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                            id="nombresestacion" placeholder="Nombre" value="{{ old('nombre') }}">
                        <label for="nombresestacion" class="ps-4">Nombre</label>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                            id="direccion" placeholder="Dirección" value="{{ old('direccion') }}">
                        <label for="direccion" class="ps-4">Dirección</label>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                            id="telefono" placeholder="Teléfono" value="{{ old('telefono') }}">
                        <label for="telefono" class="ps-4">Teléfono</label>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <select class="form-select @error('id_estacion') is-invalid @enderror" name="id_estacion" id="id_estacion">
                            <option disabled selected>Selecciona una opción...</option>
                            @foreach($estaciones as $estacion)
                                <option value="{{ $estacion->id }}" {{ old('id_estacion') == $estacion->id ? 'selected' : '' }}>
                                    {{ $estacion->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <label for="id_estacion" class="ps-4">Estación</label>
                        @error('id_estacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn"
                            style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <!-- Redirección evita reabrir modal -->
                        <a href="{{ route('subestaciones') }}" class="btn"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin de Añadir -->