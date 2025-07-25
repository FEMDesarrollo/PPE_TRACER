<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $permiso->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $permiso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $permiso->id }}" style="color: #222944;">Editar permiso</h5>
                <a href="{{ route('permisos') }}" class="btn-close" aria-label="Close"></a>
            </div>

            <div class="modal-body">
                <form action="{{ route('permisos_salvar', ['id' => $permiso->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{ $permiso->id }}">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100 @error('permiso') is-invalid @enderror" name="permiso" id="permiso{{ $permiso->id }}" placeholder="Permisos" value="{{ old('permiso', $permiso->permiso)}}">
                            <label for="permiso{{ $permiso->id }}">Permiso</label>
                            @error('permiso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control w-100 @error('url') is-invalid @enderror" name="url" id="url{{ $permiso->id }}" placeholder="URL" value="{{old('url', $permiso->url)}}">
                            <label for="url{{ $permiso->id }}">URL</label>
                            @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                    <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                    <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('permisos') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->

