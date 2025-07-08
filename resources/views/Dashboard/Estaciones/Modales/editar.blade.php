<!-- Modal de Editar -->
        <div class="modal fade" id="modalEditar{{ $estacion->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="modalEditarLabel{{ $estacion->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                        <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $estacion->id }}" style="color: #222944;">Editar estación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('estaciones_salvar', $estacion->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control w-100" name="nombre" id="nombreEstacion{{ $estacion->id }}"
                                            placeholder="Nombre" value="{{ $estacion->nombre }}" required>
                                        <label for="nombreEstacion{{ $estacion->id }}">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control w-100" name="direccion" id="direccion{{ $estacion->id }}"
                                            placeholder="Dirección" value="{{ $estacion->direccion }}" required>
                                        <label for="direccion{{ $estacion->id }}">Dirección</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control w-100" name="telefono" id="telefono{{ $estacion->id }}"
                                            placeholder="Teléfono" value="{{ $estacion->telefono }}" required>
                                        <label for="telefono{{ $estacion->id }}">Teléfono</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control w-100" name="total_trajes" id="total_trajes{{ $estacion->id }}"
                                            placeholder="Teléfono" value="{{ $estacion->total_trajes }}" required>
                                        <label for="total_trajes{{ $estacion->id }}">Total de trajes</label>
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
