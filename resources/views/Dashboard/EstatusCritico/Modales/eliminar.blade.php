        <!-- Modal de Eliminar -->
        <div class="modal fade" id="modalEliminar{{ $estado->id }}" tabindex="-1" 
            aria-labelledby="modalEliminarLabel{{ $estado->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header border-0 position-relative">
                        <button type="button" class="btn-close position-absolute top-0 end-0 p-3" data-bs-dismiss="modal"
                            aria-label="Close" style="color: red;"></button>
                    </div>
                    <form action="{{ route('estatus_critico_borrar', $estado->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <i class="bi bi-exclamation-triangle fs-1 text-danger"></i>
                            <p class="mt-3 fw-bold" style="color: #222944">
                                ¿Estás seguro de que deseas eliminar este estatus ({{ $estado->estatus }})?
                            </p>
                            <p class="text-muted">Creado el: {{ $estado->created_at->format('d/m/Y H:i') }}</p>
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