<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                     <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('usuarios_salvar', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="nombre" id="nombreUsuario{{ $user->id }}" placeholder="Nombre" value="{{ $user->nombre }}">
                                    <label for="nombreUsuario{{ $user->id }}">Nombre</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="app" id="app{{ $user->id }}" placeholder="Apellido paterno" value="{{ $user->app }}">
                                    <label for="app{{ $user->id }}">Apellido paterno</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="apm" id="apm{{ $user->id }}" placeholder="Apellido materno" value="{{ $user->apm }}">
                                    <label for="apm{{ $user->id }}">Apellido materno</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="telefono" id="telefono{{ $user->id }}" placeholder="Teléfono" value="{{ $user->telefono }}">
                                    <label for="telefono{{ $user->id }}">Teléfono</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="correo" id="correo{{ $user->id }}" placeholder="Correo" value="{{ $user->correo }}">
                                    <label for="correo{{ $user->id }}">Correo</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100" name="password" id="password{{ $user->id }}" placeholder="Contraseña" value="{{ $user->password }}">
                                    <label for="password{{ $user->id }}">Contraseña</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="file" class="form-control w-100" name="foto1" id="floatingfoto" accept=".jpg,.png,.bmp">
                                <input type="hidden" name="foto2" value="{{ $user->foto }}">
                                <label for="floatingfoto">Foto</label>
                                <div id="fotoHelp" class="form-text">Suba una foto para su perfil ( <i>Formatos</i>: jpg/png/bmp)</div>
                            </div>
                        </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_estacion" id="id_estacion{{ $user->id }}">
                                        @foreach($estaciones as $estacion)
                                            <option value="{{ $estacion->id }}" {{ $user->id_estacion == $estacion->id ? 'selected' : '' }}>
                                                {{ $estacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_estacion{{ $user->id }}">Estación</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_subestacion" id="id_subestacion{{ $user->id }}">
                                        @foreach($subestaciones as $sestacion)
                                            <option value="{{ $sestacion->id }}" {{ $user->id_subestacion == $sestacion->id ? 'selected' : '' }}>
                                                {{ $sestacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_subestacion{{ $user->id }}">Subestación</label>
                                </div>
                            </div>


                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_perfil" id="id_perfil{{ $user->id }}">
                                        @foreach($perfiles as $perfil)
                                            <option value="{{ $perfil->id }}" {{ $user->id_perfil == $perfil->id ? 'selected' : '' }}>
                                                {{ $perfil->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_perfil{{ $user->id }}">Perfil</label>
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
