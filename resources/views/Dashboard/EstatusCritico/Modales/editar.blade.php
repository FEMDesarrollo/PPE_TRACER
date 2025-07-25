        <!-- Modal de Editar -->
        <div class="modal fade" id="modalEditar{{ $estado->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditarLabel{{ $estado->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $estado->id }}" style="color: #222944;">Editar Estatus Crítico</h5>
                        <a href="{{ route('estatus_critico') }}" class="btn-close" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('estatus_critico_salvar', $estado->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $estado->id }}">

                            <div class="row g-3">
                                <div class="col-12 col-sm-6 col-md-6 form-floating">
                                    <div class="form-floating">


                                        <input type="text" class="form-control pe-5 @error('estatus') is-invalid @enderror" name="estatus" id="estatus{{ $estado->id }}" placeholder="Estatus" value="{{ old('estatus', $estado->estatus)}}"
>
                                        <label for="estatus{{ $estado->id }}">Estatus Crítico</label>
                                        @error('estatus')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                                <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                    Guardar
                                </button>
                                <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('estatus_critico') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
