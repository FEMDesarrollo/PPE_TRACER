<!-- Modal de Eliminar -->
        <div class="modal fade" id="modalEliminar{{ $gestionInspeccion->id }}" tabindex="-1" 
            aria-labelledby="modalEliminarLabel{{ $gestionInspeccion->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header border-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 p-3" data-bs-dismiss="modal"
                            aria-label="Close" style="color: red;"></button>
                    </div>
                    <form action="{{ route('gestion_inspecciones_borrar', $gestionInspeccion->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <i class="bi bi-exclamation-triangle fs-1 text-danger"></i>
                            <p class="mt-3 fw-bold" style="color: #222944">
                                ¿Estás seguro de que deseas eliminar esta observación ({{ $gestionInspeccion->observaciones }})?
                            </p>
                            <p class="text-muted">Creado el: {{ $gestionInspeccion->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="submit" class="btn" style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">
                                Eliminar
                            </button>
                            <button type="button" class="btn" data-bs-dismiss="modal" 
                                style="background-color: #222944; color: white; border-color:#222944">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>