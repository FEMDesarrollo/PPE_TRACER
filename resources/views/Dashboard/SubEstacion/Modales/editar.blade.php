<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $sestacion->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $sestacion->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Editar subestación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('subestaciones_salvar', ['id' => $sestacion->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $sestacion->id }}">


                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100 @error('nombre') is-invalid @enderror" name="nombre" id="nombreUsuario{{ $sestacion->id }}" placeholder="Nombre" value="{{ old('nombre', $sestacion->nombre )}}">
                                    <label for="nombreUsuario{{ $sestacion->id }}">Nombre</label>
                                    @error('nombre')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100 @error('direccion') is-invalid @enderror" name="direccion" id="direccion{{ $sestacion->id }}" placeholder="Dirección" value="{{ old('direccion', $sestacion->direccion )}}">
                                    <label for="direccion{{ $sestacion->id }}">Dirección</label>
                                    @error('direccion')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100 @error('telefono') is-invalid @enderror" name="telefono" id="telefono{{ $sestacion->id }}" placeholder="Teléfono" value="{{ old('telefono', $sestacion->telefono )}}">
                                    <label for="telefono{{ $sestacion->id }}">Teléfono</label>
                                    @error('telefono')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_estacion" id="id_estacion{{ $sestacion->id }}">
                                        @foreach($estaciones as $estacion)
                                            <option value="{{ $estacion->id }}" {{ $sestacion->id_estacion == $estacion->id ? 'selected' : '' }}>
                                                {{ $estacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_estacion{{ $sestacion->id }}">Estación</label>
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
@if ($errors->any() && old('id') == $sestacion->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $sestacion->id }}'));
            modal.show();
        });
    </script>
@endif
