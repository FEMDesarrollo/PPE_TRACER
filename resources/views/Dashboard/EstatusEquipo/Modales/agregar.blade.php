<!-- Modal Añadir -->
<div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalAñadirLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                <h5 class="modal-title text-center fw-bold" id="modalAñadirLabel" style="color: #222944;">Agregar Nuevo Estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('estatus_equipos_registrar') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12 col-sm-6 col-md-6 form-floating">
                        <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" required>
                        <label for="estado" class="ps-4">Estado</label>
                    </div>
                    <div class="modal-footer d-flex justify-content-center w-100">
                        <button type="submit" class="btn" style="background-color: #222944; color: white; border-color:#222944;">
                            Agregar
                        </button>
                        <button type="button" class="btn" data-bs-dismiss="modal" 
                            style="background-color: #cf0a2c; color: white; border-color:#cf0a2c;">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
