<!-- Modal de Editar -->
        <div class="modal fade" id="modalEditar{{ $servicio->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditarLabel{{ $servicio->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $servicio->id }}" style="color: #222944;">Editar Servicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('servicio_salvar', $servicio->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $servicio->id }}">

                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control pe-5 @error('servicio') is-invalid @enderror" name="servicio" id="servicio{{ $servicio->id }}" placeholder="Servicio"
                                            placeholder="Servicio" value="{{old('servicio', $servicio->servicio )}}">
                                        <label for="servicio{{ $servicio->id }}">Servicio</label>
                                        @error('servicio')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
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
<!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $servicio->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $servicio->id }}'));
            modal.show();
        });
    </script>
@endif
