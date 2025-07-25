<!--Modal de Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar nuevo usuario</h5>
                <a href="{{ route('usuarios') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuarios_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                    <input type="hidden" name="modal" value="añadir">
                    @csrf
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombreUsuarios" placeholder="Nombre" value="{{ old('nombre') }}">
                        <label for="nombreUsuarios" class="ps-4">Nombre</label>
                        @error('nombre') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="app" class="form-control @error('app') is-invalid @enderror" id="app" placeholder="Apellido paterno" value="{{ old('app') }}">
                        <label for="app" class="ps-4">Apellido paterno</label>
                        @error('app') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="apm" class="form-control @error('apm') is-invalid @enderror" id="apm" placeholder="Apellido materno" value="{{ old('apm') }}">
                        <label for="apm" class="ps-4">Apellido materno</label>
                        @error('apm') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" id="telefono" placeholder="Telefono" value="{{ old('telefono') }}">
                        <label for="telefono" class="ps-4">Teléfono</label>
                        @error('telefono') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" id="correo" placeholder="Correo" value="{{ old('correo') }}">
                        <label for="correo" class="ps-4">Correo</label>
                        @error('correo') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Contraseña">
                        <label for="password" class="ps-4">Contraseña</label>
                        @error('password') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="foto" accept=".jpg,.png,.bmp">
                        <label for="foto" class="ps-4">Foto</label>
                        <div id="fotoHelp" class="form-text">Suba una foto para el usuario (<i>Formatos</i>: jpg/png/bmp)</div>
                        @error('foto') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('id_estacion') is-invalid @enderror" name="id_estacion" id="id_estacion" >
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach($estaciones as $estacion)
                                    <option value="{{ $estacion->id }}" {{ old('id_estacion') == $estacion->id ? 'selected' : '' }}>
                                        {{ $estacion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="id_estacion" class="ps-4">Estación</label>
                            @error('id_estacion') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-floating">
                            <select name="id_subestacion" class="form-select @error('id_subestacion') is-invalid @enderror" id="id_subestacion">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach($subestaciones as $sestacion)
                                    <option value="{{ $sestacion->id }}" {{ old('id_subestacion') == $sestacion->id ? 'selected' : ''}}>
                                        {{ $sestacion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="id_subestacion" class="ps-4">Subestación</label>
                            @error('id_subestacion') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-floating">
                            <select name="id_perfil" class="form-select @error('id_perfil') is-invalid @enderror"  id="id_perfil">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach($perfiles as $perfil)
                                    <option value="{{ $perfil->id }}" {{ old('id_perfil') == $perfil->id ? 'selected' : '' }}>
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="id_perfil" class="ps-4">Perfil</label>
                            @error('id_perfil') 
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>   
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                        <!-- Redirección evita reabrir modal -->
                        <a href="{{ route('usuarios') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Fin de Añadir -->