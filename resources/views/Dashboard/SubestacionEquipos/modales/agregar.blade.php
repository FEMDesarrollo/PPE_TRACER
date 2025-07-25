    <!--Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Equipo de subestación</h5>
                    <a href="{{ route('subestacion_equipos') }}" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subestacion_equipos_registrar') }}" method="POST" class="row g-3">
                        <input type="hidden" name="modal" value="añadir">
                        @csrf
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="no_traje" class="form-control @error('no_traje') is-invalid @enderror" id="no_traje" placeholder="Número de Traje" value="{{ old('no_traje') }}">
                            <label for="no_traje" class="ps-4">Número de Traje</label>
                            @error('no_traje')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_equipo" class="form-select @error('id_equipo') is-invalid @enderror" id="id_equipo" >
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}" {{ old('id_equipo') == $equip->id ? 'selected' : '' }}>
                                            {{ $equip->equipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_equipo">Equipo</label>
                                @error('id_equipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_estacion" class="form-select @error('id_estacion') is-invalid @enderror" id="id_estacion" >
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}" {{ old('id_estacion') == $estacion->id ? 'selected' : '' }}>
                                            {{ $estacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_estacion">Estación</label>
                                @error('id_estacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_subestacion" class="form-select @error('id_subestacion') is-invalid @enderror" id="id_subestacion" >
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach($subEstacion as $sestacion)
                                        <option value="{{ $sestacion->id }}" {{ old('id_subestacion') == $sestacion->id ? 'selected' : '' }}>
                                            {{ $sestacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_subestacion">Subestación</label>
                                @error('id_subestacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" data-bs-dismiss="modal"
                            style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                            <!-- Redirección evita reabrir modal -->
                            <a href="{{ route('subestacion_equipos') }}" class="btn"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Fin de Añadir -->