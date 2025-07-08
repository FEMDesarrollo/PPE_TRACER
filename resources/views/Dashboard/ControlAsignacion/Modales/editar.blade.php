<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $controlasi->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $controlasi->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $controlasi->id }}" style="color: #222944;">Editar el control de asignaciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('control_asignaciones_salvar', ['id' => $controlasi->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row g-3">


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="observaciones" id="observaciones{{ $controlasi->id }}" placeholder="Observaciones" value="{{ $controlasi->observaciones }}">
                                    <label for="observaciones{{ $controlasi->id }}">Observaciones</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control w-100" name="fecha_asignacion" id="fecha_asignacion{{ $controlasi->id }}" placeholder="Fecha de asignacion" value="{{ $controlasi->fecha_asignacion }}">
                                    <label for="fecha_asignacion{{ $controlasi->id }}">Fecha de asignacion</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control w-100" name="fecha_devolucion" id="fecha_devolucion{{ $controlasi->id }}" placeholder="Fecha de devolucion" value="{{ $controlasi->fecha_devolucion }}">
                                    <label for="fecha_devolucion{{ $controlasi->id }}">Fecha de devolucion</label>
                                </div>
                            </div>



                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario_equipo" id="id_usuario_equipo{{ $controlasi->id }}">
                                        @foreach($usuarios_equipos as $userequipo)
                                            <option value="{{ $userequipo->id }}" {{ $controlasi->id_usuario_equipo == $userequipo->id ? 'selected' : '' }}>
                                                {{ $userequipo->fecha_estatus }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario_equipo{{ $controlasi->id }}">Fecha de estatus</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_estatus_critico" id="id_estatus_critico{{ $controlasi->id }}">
                                        @foreach($estatus_critico as $estado)
                                            <option value="{{ $estado->id }}" {{ $controlasi->id_estatus_critico == $estado->id ? 'selected' : '' }}>
                                                {{ $estado->estatus }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_estatus_critico{{ $controlasi->id }}">Estatus critico</label>
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
