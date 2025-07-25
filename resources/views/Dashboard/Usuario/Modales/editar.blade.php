<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Editar usuario</h5>
                <a href="{{ route('usuarios') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
            <form action="{{ route('usuarios_salvar', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100 @error('nombre') is-invalid @enderror" name="nombre" id="nombreUsuario{{ $user->id }}" placeholder="Nombre" value="{{old('nombre', $user->nombre )}}">
                                <label for="nombreUsuario{{ $user->id }}">Nombre</label>
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100 @error('app') is-invalid @enderror" name="app" id="app{{ $user->id }}" placeholder="Apellido paterno" value="{{old('app', $user->app )}}">
                                <label for="app{{ $user->id }}">Apellido paterno</label>
                                @error('app')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100 @error('apm') is-invalid @enderror" name="apm" id="apm{{ $user->id }}" placeholder="Apellido materno" value="{{old('apm', $user->apm )}}">
                                <label for="apm{{ $user->id }}">Apellido materno</label>
                                @error('apm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100 @error('telefono') is-invalid @enderror" name="telefono" id="telefono{{ $user->id }}" placeholder="Teléfono" value="{{old('telefono', $user->telefono )}}">
                                <label for="telefono{{ $user->id }}">Teléfono</label>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control w-100 @error('correo') is-invalid @enderror" name="correo" id="correo{{ $user->id }}" placeholder="Correo" value="{{old('correo', $user->correo )}}">
                                <label for="correo{{ $user->id }}">Correo</label>
                                @error('correo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control w-100 @error('password') is-invalid @enderror" 
                                    name="password" id="password{{ $user->id }}" placeholder="Contraseña" value="">
                                <label for="password{{ $user->id }}">Contraseña</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="file" class="form-select @error('foto1') is-invalid @enderror" name="foto1" id="floatingfoto" accept=".jpg,.png,.bmp">
                                <input type="hidden" name="foto2" value="{{ $user->foto }}">
                                <label for="floatingfoto">Foto</label>
                                <div id="fotoHelp" class="form-text">Imagen Actual: {{ $user->foto }}</div>
                                @error('foto1') 
                                    <div class="invalid-feedback">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_estacion') is-invalid @enderror" name="id_estacion" id="id_estacion{{ $user->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}"
                                            {{ old('id_estacion', $user->id_estacion) == $estacion->id ? 'selected' : '' }}>
                                            {{ $estacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_estacion{{ $user->id }}">Estación</label>
                                @error('id_estacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_subestacion') is-invalid @enderror" name="id_subestacion" id="id_subestacion{{ $user->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($subestaciones as $sestacion)
                                        <option value="{{ $sestacion->id }}" 
                                            {{ old('id_subestacion', $user->id_subestacion) == $sestacion->id ? 'selected' : '' }}>
                                            {{ $sestacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_subestacion{{ $user->id }}">Subestación</label>
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_perfil') is-invalid @enderror" name="id_perfil" id="id_perfil{{ $user->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($perfiles as $perfil)
                                        <option value="{{ $perfil->id }}"
                                            {{ old('id_perfil', $user->id_perfil) == $perfil->id ? 'selected' : '' }}>
                                            {{ $perfil->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_perfil{{ $user->id }}">Perfil</label>
                                @error('id_perfil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                        <!-- Redirección evita reabrir modal -->
                        <a href="{{ route('usuarios') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->

