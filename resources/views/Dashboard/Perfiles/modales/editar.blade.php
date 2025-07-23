<!-- Modal de Editar -->
    <div class="modal fade" id="modalEditar{{ $perfil->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalEditarLabel{{ $perfil->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $perfil->id }}" style="color: #222944;">Editar Perfil</h5>
                <a href="{{ route('perfiles') }}" class="btn-close" aria-label="Close"></a>
                </div>

                <div class="modal-body">
                    <form action="{{ route('perfiles_salvar', ['id' => $perfil->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <!-- Campo oculto para identificar el ID enviado -->
                    <input type="hidden" name="id" value="{{ $perfil->id }}">

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control pe-5 @error('nombre') is-invalid @enderror" name="nombre" id="nombres{{ $perfil->id }}" placeholder="Nombre" value="{{old('nombre', $perfil->nombre)}}">
                                    <label for="nombre{{ $perfil->id }}">Nombre</label>
                                @error('nombre')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                            <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                            <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('perfiles') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Fin de Editar -->
