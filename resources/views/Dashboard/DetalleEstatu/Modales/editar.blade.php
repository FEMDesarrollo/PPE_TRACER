<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $detallesta->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $detallesta->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $detallesta->id }}" style="color: #222944;">Editar detalle del estatus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <form action="{{ route('detalles_estatus_salvar', ['id' => $detallesta->id]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{ $detallesta->id }}">

                        <div class="row g-3">
                        <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control w-100 @error('total_respuesta') is-invalid @enderror" name="total_respuesta" id="total_respuesta{{ $detallesta->id }}" placeholder="Total de respuesta" value="{{ old('total_respuesta', $detallesta->total_respuesta )}}">
                                    <label for="total_respuesta{{ $detallesta->id }}">Total de respuesta</label>
                                    @error('total_respuesta')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_estatus" id="id_estatus{{ $detallesta->id }}">
                                        @foreach($estatus_critico as $estado)
                                            <option value="{{ $estado->id }}" {{ $detallesta->id_estatus == $estado->id ? 'selected' : '' }}>
                                                {{ $estado->estatus }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_estatus{{ $detallesta->id }}">Estatus</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" name="id_usuario" id="id_usuario{{ $detallesta->id }}">
                                        @foreach($usuario as $user)
                                            <option value="{{ $user->id }}" {{ $detallesta->id_usuario == $user->id ? 'selected' : '' }}>
                                                {{ $user->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="id_usuario{{ $detallesta->id }}">Nombre de usuario</label>
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
@if ($errors->any() && old('id') == $detallesta->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $detallesta->id }}'));
            modal.show();
        });
    </script>
@endif
