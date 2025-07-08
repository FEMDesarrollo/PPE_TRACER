<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $userequipo->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $userequipo->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $userequipo->id }}" style="color: #222944;">Editar usuario de equipo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('usuarios_equipos_salvar', ['id' => $userequipo->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control w-100" name="fecha_estatus" id="fecha{{ $userequipo->id }}" placeholder="Fecha" value="{{ $userequipo->fecha_estatus }}">
                                    <label for="fecha{{ $userequipo->id }}">Fecha</label>
                                </div>
                            </div>


                        <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="comentarios" id="comentarios{{ $userequipo->id }}" placeholder="Comentarios" value="{{ $userequipo->comentarios }}">
                                    <label for="comentarios{{ $userequipo->id }}">Comentarios</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_estatus_equipo" id="id_estatus_equipo{{ $userequipo->id }}">
                                        @foreach($estatus_equipo as $estatusEquipo)
                                            <option value="{{ $estatusEquipo->id }}" {{ $userequipo->id_estatus_equipo == $estatusEquipo->id ? 'selected' : '' }}>
                                                {{ $estatusEquipo->estado }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_estatus_equipo{{ $userequipo->id }}">Estado</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario" id="id_usuario{{ $userequipo->id }}">
                                        @foreach($usuario as $user)
                                            <option value="{{ $user->id }}" {{ $userequipo->id_usuario == $user->id ? 'selected' : '' }}>
                                                {{ $user->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario{{ $userequipo->id }}">Nombre de usuario</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_equipo" id="id_equipo{{ $userequipo->id }}">
                                        @foreach($equipo as $equip)
                                            <option value="{{ $equip->id }}" {{ $userequipo->id_usuario == $equip->id ? 'selected' : '' }}>
                                                {{ $equip->equipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_equipo{{ $userequipo->id }}">Equipo</label>
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
