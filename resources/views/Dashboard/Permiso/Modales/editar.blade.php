<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $permiso->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $permiso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $permiso->id }}" style="color: #222944;">Editar permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('permisos_salvar', ['id' => $permiso->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" name="permiso" id="permiso{{ $permiso->id }}" placeholder="Permisos" value="{{ $permiso->permiso }}">
                            <label for="permiso{{ $permiso->id }}">Permiso</label>
                        </div>
                    </div>
                    

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" name="url" id="url{{ $permiso->id }}" placeholder="URL" value="{{ $permiso->url }}">
                            <label for="url{{ $permiso->id }}">URL</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center w-100 mt-3">
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
