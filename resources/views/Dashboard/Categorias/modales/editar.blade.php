<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $categoria->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $categoria->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $categoria->id }}" style="color: #222944;">Editar Categoria</h5>
                                <a href="{{ route('categorias') }}" class="btn-close" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="{{ route('categorias_salvar', ['id' => $categoria->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    
                    <!-- Campo oculto para identificar el ID enviado -->
                    <input type="hidden" name="id" value="{{ $categoria->id }}">

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-5 @error('categoria') is-invalid @enderror" name="categoria" id="categoria{{ $categoria->id }}" placeholder="Categoria"
                                    value="{{ old('categoria', $categoria->categoria) }}">
                                <label for="categoria{{ $categoria->id }}">Categoria</label>
                                @error('categoria')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('id_equipo') is-invalid @enderror" name="id_equipo" id="id_equipo{{ $categoria->id }}">
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}"
                                            {{ old('id_equipo', $categoria->id_equipo) == $equip->id ? 'selected' : '' }}>
                                            {{ $equip->equipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_equipo{{ $categoria->id }}">Equipo</label>
                                @error('id_equipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center w-100 mt-4">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944">Editar</button>
                        <!-- Redirección limpia para evitar reabrir modal -->
                        <a href="{{ route('categorias') }}" class="btn"
                           style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin de Editar -->

<!-- Script para mostrar el modal si hay errores y coincide el ID -->
@if ($errors->any() && old('id') == $categoria->id)
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal = new bootstrap.Modal(document.getElementById('modalEditar{{ $categoria->id }}'));
            modal.show();
        });
    </script>
@endif
