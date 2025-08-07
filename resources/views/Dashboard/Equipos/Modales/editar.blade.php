<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $equipo->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $equipo->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $equipo->id }}" style="color: #222944;">Editar Equipo</h5>
                <a href="{{ route('equipos') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('equipos_salvar', $equipo->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $equipo->id }}">

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-5 @error('equipo') is-invalid @enderror" name="equipo" id="equipo{{ $equipo->id }}" placeholder="Equipo" value="{{ old('equipo', $equipo->equipo )}}">
                                <label for="equipo{{ $equipo->id }}">Equipo</label>
                                @error('equipo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                        <a href="{{ route('equipos') }}" class="btn"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->
 <!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $equipo->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $equipo->id }}'));
            modal.show();
        });
    </script>
@endif
