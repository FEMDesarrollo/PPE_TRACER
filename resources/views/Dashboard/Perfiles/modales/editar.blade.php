<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $perfil->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $perfil->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $perfil->id }}" style="color: #222944;">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('perfiles_salvar', $perfil->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="col-12 col-sm-6 col-md-6 form-floating">
                                <input type="text" class="form-control w-100" name="nombre" id="nombrePerfil{{ $perfil->id }}" 
                                    placeholder="Nombre" value="{{ $perfil->nombre }}" required>
                                <label for="nombrePerfil{{ $perfil->id }}">Nombre</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">
                            Guardar cambios
                        </button>
                        <button type="button" class="btn" data-bs-dismiss="modal"
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->