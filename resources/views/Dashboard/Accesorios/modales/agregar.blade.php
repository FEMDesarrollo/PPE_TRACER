<!--Modal de Añadir -->
    <div class="modal fade" id="modalAñadir" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header d-grid" style="grid-template-columns: 1fr auto;">
                    <h5 class="modal-title text-center fw-bold" id="staticBackdropLabel" style="color: #222944;">Agregar Nuevo Accesorio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAñadir" action="{{ route('accesorios_registrar') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="nombre" class="form-control pe-5 @error('nombre') is-invalid @enderror" id="nombreAccesorio" placeholder="Accesorio" value="{{ old('nombre') }}">
                            <label for="nombreAccesorio" class="ps-4">Accesorio</label>
                            @error('nombre')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="file" name="imagen" class="form-control" id="imagen" accept=".jpg,.png,.bmp" value="{{ old('imagen') }}">
                            <label for="nombreAccesorio" class="ps-4">Accesorio</label>
                            <label for="imagen" class="ps-4">Imagen</label>
                             <div id="fotoHelp" class="form-text">Suba una foto para el accesorio (<i>Formatos</i>: jpg/png/bmp)</div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" id="marca" placeholder="Marca" value="{{ old('marca') }}">
                            <label for="marca" class="ps-4">Marca</label>
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" id="modelo" placeholder="Modelo" value="{{ old('modelo') }}">
                            <label for="modelo" class="ps-4">Modelo</label>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 form-floating">
                            <input type="text" name="detalle_descripcion" class="form-control @error('detalle_descripcion') is-invalid @enderror"  id="detalle_descripcion" placeholder="Descripción" value="{{ old('detalle_descripcion') }}">
                            <label for="detalle_descripcion" class="ps-4">Descripción</label>
                            @error('detalle_descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="form-floating">
                                <select name="id_equipo" class="form-select @error('id_equipo') is-invalid @enderror" id="id_equipo" required>
                                    <option disabled selected>Selecciona una opción...</option>
                                    @foreach($equipos as $equip)
                                        <option value="{{ $equip->id }}" {{ old('id_equipo') == $equip->id ? 'selected' : '' }}>
                                            {{ $equip->equipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="id_equipo">Equipo</label>
                                @error('id_equipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center w-100">
                            <button type="submit" class="btn" data-bs-dismiss="modal"
                                style="background-color: #222944; color: white; border-color:#222944">Guardar</button>
                            <button type="button" class="btn" data-bs-dismiss="modal"
                                style="background-color: #cf0a2c; color: white; border-color:#cf0a2c" onclick="resetFormulario()">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Fin de Añadir -->


    <!--Redirección de formulario si hay errores en las validaciones -->
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById('modalAñadir'));
                myModal.show();
            });
        </script>
    @endif
    <!--Fin de redirección de formulario si hay errores en las validaciones -->


    <script>
    function resetFormulario() {
        document.getElementById('formAñadir').reset();

        // Para limpiar estilos de validación si es necesario
        document.querySelectorAll('#formAñadir .is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
    }
</script>
