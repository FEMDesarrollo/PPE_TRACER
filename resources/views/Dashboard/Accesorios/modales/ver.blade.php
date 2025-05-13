 <!-- Modal de Ver -->
 
<div class="modal fade" id="modalVer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
            <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">
                Información de Accesorio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Foto de accesorio centrada -->
        <div class="text-center mt-3">
            <img src="../img/Perfil.png" alt="Foto de Perfil" class="rounded-circle img-fluid"
                style="width: 120px; height: 120px; object-fit: cover;">
        </div>
        <div class="modal-body">
            <form class="row g-3">
                <div class="col-12 col-md-4 form-floating">
                    <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre">
                    <label for="nombreUsuario" class="ps-4">Nombre</label>
                </div>
                <div class="col-12 col-md-4 form-floating">
                    <input type="text" class="form-control" id="apellidoPaterno"
                        placeholder="Apellido Paterno">
                    <label for="apellidoPaterno" class="ps-4">Marca</label>
                </div>
                <div class="col-12 col-md-4 form-floating">
                    <input type="text" class="form-control" id="apellidoMaterno"
                        placeholder="Apellido Materno">
                    <label for="apellidoMaterno" class="ps-4">Modelo</label>
                </div>
                <div class="col-12">
                    <label for="subEstacion" class="form-label">Equipo</label>
                    <select id="subEstacion" class="form-select">
                        <option selected>Seleccione uno...</option>
                        <option value="1">Estructural</option>
                        <option value="2">Rescate</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Especificaciones" id="floatingTextarea" style="height: 100px"></textarea>
                        <label for="floatingTextarea">Descripción del Accesorio</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn" data-bs-dismiss="modal"
                style="background-color: #222944; color: white; border-color:#222944">Editar</button>
            <button type="button" class="btn" data-bs-dismiss="modal"
                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
        </div>
    </div>
</div>
</div>

 <!-- Fin de Ver-->