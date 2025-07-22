<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $subEE->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $subEE->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $subEE->id }}" style="color: #222944;">Editar Equipo de subestación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('subestacion_equipos_salvar', ['id' => $subEE->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="id" value="{{ $subEE->id }}">


                    <div class="row g-3">
                         <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100  @error('no_traje') is-invalid @enderror" name="no_traje" id="no_traje{{ $subEE->id }}" placeholder="Número traje" value="{{old('no_traje', $subEE->no_traje )}}">
                                <label for="no_traje{{ $subEE->id }}">Número traje</label>
                                @error('no_traje')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_equipo" id="id_equipo{{ $subEE->id }}">
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}" {{ $subEE->id_equipo == $equip->id ? 'selected' : '' }}>
                                            {{ $equip->equipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_equipo{{ $subEE->id }}">Equipo</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_estacion" id="id_estacion{{ $subEE->id }}">
                                    @foreach($estaciones as $estacion)
                                        <option value="{{ $estacion->id }}" {{ $subEE->id_estacion == $estacion->id ? 'selected' : '' }}>
                                            {{ $estacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_estacion{{ $subEE->id }}">Estación</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_subestacion" id="id_subestacion{{ $subEE->id }}">
                                    @foreach($subEstacion as $sestacion)
                                        <option value="{{ $sestacion->id }}" {{ $subEE->id_subestacion == $sestacion->id ? 'selected' : '' }}>
                                            {{ $sestacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_subestacion{{ $subEE->id }}">Subestación</label>
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
 <!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $subEE->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $subEE->id }}'));
            modal.show();
        });
    </script>
@endif
