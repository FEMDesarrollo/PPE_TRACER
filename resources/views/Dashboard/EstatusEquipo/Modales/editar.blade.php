<!-- Modal Editar -->
<div class="modal fade" id="modalEditar{{ $estatusEquipo->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $estatusEquipo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $estatusEquipo->id }}" style="color: #222944;">Editar Estado</h5>
                <a href="{{ route('estatus_equipos') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('estatus_equipos_salvar', $estatusEquipo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $estatusEquipo->id }}">

                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" class="form-control @error('estado') is-invalid @enderror" name="estado" id="estado{{ $estatusEquipo->id }}"placeholder="Estado" value="{{old('estado', $estatusEquipo->estado)}}" >
                            <label for="estado{{ $estatusEquipo->id }}">Estado</label>
                            @error('estado')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-3">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944;">Editar</button>
                        <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('estatus_equipos') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->
