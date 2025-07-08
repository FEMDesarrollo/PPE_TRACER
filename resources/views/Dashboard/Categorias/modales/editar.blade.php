<!-- Modal de Editar -->
<div class="modal fade" id="modalEditar{{ $categoria->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditarLabel{{ $categoria->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalEditarLabel{{ $categoria->id }}" style="color: #222944;">Editar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('categorias_salvar', ['id' => $categoria->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row g-3">

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control w-100" name="categoria" id="categoria{{ $categoria->id }}" placeholder="Categoria" value="{{ $categoria->categoria }}">
                                <label for="categoria" class="ps-4">Categoria</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="id_equipo" id="id_equipo{{ $categoria->id }}">
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}" {{ $categoria->id_equipo == $equip->id ? 'selected' : '' }}>
                                            {{ $equip->equipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_equipo{{ $categoria->id }}">Equipo</label>
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