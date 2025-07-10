<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $detallequi->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $detallequi->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $detallequi->id }}" style="color: #222944;">Editar el detalle de equipo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('detalles_equipos_salvar', ['id' => $detallequi->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row g-3">


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="modelo" id="modelo{{ $detallequi->id }}" placeholder="Modelo" value="{{ $detallequi->modelo }}">
                                    <label for="modelo{{ $detallequi->id }}">Modelo</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="no_serie" id="no_serie{{ $detallequi->id }}" placeholder="Numero de serie" value="{{ $detallequi->no_serie }}">
                                    <label for="no_serie{{ $detallequi->id }}">Numero de serie</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="talla" id="talla{{ $detallequi->id }}" placeholder="Talla" value="{{ $detallequi->talla }}">
                                    <label for="talla{{ $detallequi->id }}">Talla</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control w-100" name="piezas" id="piezas{{ $detallequi->id }}" placeholder="Piezas" value="{{ $detallequi->piezas }}">
                                    <label for="piezas{{ $detallequi->id }}">Piezas</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control w-100" name="fecha_fabricacion" id="fecha_fabricacion{{ $detallequi->id }}" placeholder="Fecha de fabricacion" value="{{ $detallequi->fecha_fabricacion }}">
                                    <label for="fecha_fabricacion{{ $detallequi->id }}">Fecha de asignacion</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario_equipo" id="id_usuario_equipo{{ $detallequi->id }}">
                                        @foreach($usuarios_equipos as $userequipo)
                                            <option value="{{ $userequipo->id }}" {{ $detallequi->id_usuario_equipo == $userequipo->id ? 'selected' : '' }}>
                                                {{ $userequipo->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario_equipo{{ $detallequi->id }}">Id de Usuario equipos</label>
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
