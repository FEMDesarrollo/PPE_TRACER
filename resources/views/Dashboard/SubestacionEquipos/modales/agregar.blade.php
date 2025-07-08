    <!--Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Equipo de subestación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('subestacion_equipos_registrar') }}" method="POST" class="row g-3">
                        {{ csrf_field() }}

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="number" name="no_traje" class="form-control" id="no_traje" placeholder="Número de Traje">
                            <label for="no_traje" class="ps-4">Número de Traje</label>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_equipo" class="form-select" id="id_equipo" required>
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}">{{ $equip->equipo }}</option>
                                    @endforeach
                                </select>
                                <label for="id_servicio">Equipo</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_estacion" class="form-select" id="id_estacion">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}">{{ $estacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="id_estacion" class="ps-4">Estación</label>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_subestacion" class="form-select" id="id_subestacion">
                                    <option selected disabled>Selecciona una opción...</option>
                                    @foreach($subEstacion as $sestacion)
                                        <option value="{{ $sestacion->id }}">{{ $sestacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="id_subestacion" class="ps-4">SubEstación</label>
                            </div>
                        </div>
                        
                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" data-bs-dismiss="modal"
                                style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Fin de Añadir -->