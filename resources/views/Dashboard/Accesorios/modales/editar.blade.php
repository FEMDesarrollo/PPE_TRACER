<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $accesorio->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $accesorio->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $accesorio->id }}" style="color: #222944;">Editar Accesorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('accesorios_salvar', ['id' => $accesorio->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-5 @error('nombre') is-invalid @enderror" name="nombre" id="nombreAccesorio{{ $accesorio->id }}" placeholder="Nombre" value="{{ $accesorio->nombre }}">
                                <label for="nombreAccesorio{{ $accesorio->id }}">Nombre</label>
                                @error('nombre')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                       <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="file" class="form-control w-100" name="imagen1" id="floatingfoto" accept=".jpg,.png,.bmp">
                                <input type="hidden" name="imagen2" value="{{ $accesorio->imagen }}">
                                <label for="floatingfoto">Foto</label>
                                <div id="fotoHelp" class="form-text">Imagen Actuatual: {{ $accesorio->imagen }}  </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" id="marca{{ $accesorio->id }}" placeholder="Marca" value="{{ $accesorio->marca }}">
                                <label for="marca{{ $accesorio->id }}">Marca</label>
                                @error('marca')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" id="modelo{{ $accesorio->id }}" placeholder="Modelo" value="{{ $accesorio->modelo }}">
                                <label for="nombreProveedor{{ $accesorio->id }}">Modelo</label>
                                @error('modelo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('detalle_descripcion') is-invalid @enderror" name="detalle_descripcion" id="detalle_descripcion{{ $accesorio->id }}" placeholder="Detalle Descripción" value="{{ $accesorio->detalle_descripcion }}">
                                <label for="detalle_descripcion{{ $accesorio->id }}">Detalle Descripción</label>
                                @error('detalle_descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_equipo') is-invalid @enderror" name="id_equipo" id="id_equipo{{ $accesorio->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}" {{ old('id_equipo', $accesorio->id_equipo) == $equip->id ? 'selected' : '' }}>
                                            {{ $equip->equipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_equipo{{ $accesorio->id }}">Equipo</label>
                                @error('id_equipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Guardar</button>
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->
