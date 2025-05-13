 <!--Modal de Añadir -->
 <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
             <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                 <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar
                     Nuevo Accesorio</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form class="row g-3 " action="{{ route('accesorios.store') }}" id="modalAgregar" method="POST"
                     enctype="multipart/form-data">
                     @csrf
                     <div class="col-12 col-md-4 form-floating">
                         <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre"
                             value="{{ old('nombre') }}">
                         <label for="nombre" class="ps-4">Nombre</label>
                         <div class="invalid-feedback" id="error-nombre"></div>

                     </div>
                     <div class="col-12 col-md-4 form-floating">
                         <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca"
                             value="{{ old('marca') }}">
                         <label for="marca" class="ps-4">Marca</label>
                         <div class="invalid-feedback" id="error-marca"></div>
                     </div>
                     <div class="col-12 col-md-4 form-floating">
                         <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo"
                             value="{{ old('modelo') }}">
                         <label for="modelo" class="ps-4">Modelo</label>
                         <div class="invalid-feedback" id="error-modelo"></div>
                     </div>
                     <div class="col-12">
                         <label for="imagen">Foto del accesorio</label>
                         <input class="form-control" type="file" name="imagen" id="imagen">
                     </div>
                     <div class="col-12">
                         <label for="equipo" class="form-label">Equipo</label>
                         <select id="equipo" class="form-select" name="id_equipo">
                             <option selected>Seleccione uno...</option>
                             @foreach ($equipos as $equipo)
                                 <option value={{ $equipo->id }}>{{ $equipo->equipo }}</option>
                             @endforeach
                         </select>
                     </div>
                     <div class="col-12">
                         <div class="form-floating">
                             <textarea class="form-control" placeholder="Descripción" id="floatingTextarea" style="height: 100px"
                             name="detalle_descripcion" value="{{ old('detalle_descripcion') }}"></textarea>
                             <label for="floatingTextarea">Descripción del Accesorio</label>
                             <div class="invalid-feedback" id="error-floatingTextarea"></div>
                         </div>
                     </div>

                 </form>

                 <div class="modal-footer d-flex justify-content-center w-100">
                    <button type="submit" class="btn btn-primary" form="modalAgregar"
                        style="background-color: #222944; color: white; border-color:#222944">Agregar</button>
                    <button type="button" class="btn" data-bs-dismiss="modal"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Cancelar</button>
                </div>
             </div>

         </div>
     </div>
 </div>

 <script>
$(document).ready(function () {
    $("#modalAgregar").submit(function (event) {
        event.preventDefault(); 

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('accesorios.store') }}", 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').val()
            },
            success: function (response) {
                if (response.success) {

                    $("#modalAñadir").modal("hide");

                    formData.reset();

                    actualizarTabla();

                } else {
                    alert("Hubo un error al guardar el accesorio.");
                }
            },
            error: function (xhr) {
                console.error("Error en la petición AJAX:", xhr);
                alert("Ocurrió un error. Revisa la consola.");
            }
        });
    });

    // Función para actualizar la tabla 
    function actualizarTabla() {
        $.ajax({
            url: "{{ route('accesorios.index') }}",
            type: "GET",
            success: function (data) {
                $("#tablaAccesorios").html(data); // Actualiza los datos de la tabla
            },
            error: function (xhr) {
                console.error("Error al actualizar la tabla:", xhr);
            }
        });
    }
});

</script>

 <!--Fin de Añadir -->
