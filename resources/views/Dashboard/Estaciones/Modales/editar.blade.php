<!-- Modal de Editar -->
        <div class="modal fade" id="modalEditar{{ $estacion->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditarLabel{{ $estacion->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $estacion->id }}" style="color: #222944;">Editar estación</h5>
                        <a href="{{ route('estaciones') }}" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('estaciones_salvar', $estacion->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $estacion->id }}">

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control w-100 @error('nombre') is-invalid @enderror" name="nombre" id="nombreEstacion{{ $estacion->nombre}}"
                                            placeholder="Nombre" value="{{old('nombre', $estacion->nombre )}}">
                                        <label for="nombreEstacion{{ $estacion->id }}">Nombre</label>
                                        @error('nombre')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control w-100 @error('direccion') is-invalid @enderror" name="direccion" id="direccion{{$estacion->direccion }}"
                                            placeholder="Dirección" value="{{old('direccion',  $estacion->direccion )}}">
                                        <label for="direccion{{ $estacion->id }}">Dirección</label>
                                        @error('direccion')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control w-100 @error('telefono') is-invalid @enderror" name="telefono" id="telefono{{ $estacion->telefono }}"
                                            placeholder="Teléfono" value="{{old('telefono', $estacion->telefono )}}">
                                        <label for="telefono{{ $estacion->id }}">Teléfono</label>
                                        @error('telefono')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control w-100 @error('total_trajes') is-invalid @enderror" name="total_trajes" id="total_trajes{{ $estacion->total_trajes }}"
                                            placeholder="Teléfono" value="{{old('total_trajes', $estacion->total_trajes )}}">
                                        <label for="total_trajes{{ $estacion->id }}">Total de trajes</label>
                                        @error('total_trajes')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                                <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                    Editar
                                </button>
                                <a href="{{ route('estaciones') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $estacion->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $estacion->id }}'));
            modal.show();
        });
    </script>
@endif
