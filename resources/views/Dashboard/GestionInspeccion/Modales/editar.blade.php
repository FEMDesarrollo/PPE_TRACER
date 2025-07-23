<!-- Modal de Editar -->
        <div class="modal fade" id="modalEditar{{ $gestionInspeccion->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditarLabel{{ $gestionInspeccion->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $gestionInspeccion->id }}" style="color: #222944;">Editar Observación</h5>
                        <a href="{{ route('gestion_inspecciones') }}" class="btn-close" aria-label="Close"></a>
                        </div>
                    <div class="modal-body">
                        <form action="{{ route('gestion_inspecciones_salvar', $gestionInspeccion->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $gestionInspeccion->id }}">

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                                        <input type="text" class="form-control pe-5 @error('observaciones') is-invalid @enderror" name="observaciones" id="observaciones{{ $gestionInspeccion->id }}" placeholder="Observaciones" value="{{old('observaciones', $gestionInspeccion->observaciones)}}">
                                        <label for="observaciones{{ $gestionInspeccion->id }}">Observaciones</label>
                                        @error('observaciones')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                                <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                    Editar
                                </button>
                                <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('gestion_inspecciones') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
