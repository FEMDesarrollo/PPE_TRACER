<!-- Modal de Editar -->
        <div class="modal fade" id="modalEditar{{ $proveedor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditarLabel{{ $proveedor->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $proveedor->id }}" style="color: #222944;">Editar Proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('proveedores_salvar', $proveedor->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $proveedor->id }}">

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control pe-5 @error('nombre') is-invalid @enderror" name="nombre" id="nombreUsuario{{ $proveedor->id }}"
                                            placeholder="Nombre" value="{{old('nombre', $proveedor->nombre )}}">
                                        <label for="nombreUsuario{{ $proveedor->id }}">Nombre</label>
                                        @error('nombre')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control pe-5 @error('direccion') is-invalid @enderror" name="direccion" id="direccion{{ $proveedor->id }}"
                                            placeholder="Dirección" value="{{ old('direccion', $proveedor->direccion )}}">
                                        <label for="direccion{{ $proveedor->id }}">Dirección</label>
                                        @error('direccion')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control pe-5 @error('telefono') is-invalid @enderror" name="telefono" id="telefono{{ $proveedor->id }}"
                                            placeholder="Teléfono" value="{{old('telefono', $proveedor->telefono )}}">
                                        <label for="telefono{{ $proveedor->id }}">Teléfono</label>
                                        @error('telefono')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center w-100 mt-3">
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
<!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $proveedor->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $proveedor->id }}'));
            modal.show();
        });
    </script>
@endif
