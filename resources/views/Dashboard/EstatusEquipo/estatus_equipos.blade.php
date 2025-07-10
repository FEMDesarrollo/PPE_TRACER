@extends('Layouts.app')
@section('title', 'PPE TRACER')
@section('page_title', 'PANEL ADMINISTRATIVO')
@section('subtitle', 'Estatus de equipo')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Contenedor superior de tabla -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 p-4 gap-3">
                        <!-- Selector de entradas -->
                        <div class="col-12 col-md-3 d-flex align-items-center gap-2">
                            <form method="GET" action="{{ route('estatus_equipos') }}" id="entriesForm">
                                <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                @if(request('time_filter'))
                                    <input type="hidden" name="time_filter" value="{{ request('time_filter') }}">
                                @endif
                                <label for="entries" class="mb-0">Entradas por página</label>
                            </form>
                        </div>

                        <!-- Filtros combinados -->
                        <div class="col-12 col-md-6">
                            <form method="GET" action="{{ route('estatus_equipos') }}">
                                <div class="row g-2">
                                    <!-- Buscador -->
                                    <div class="col-md-6">
                                        <div class="input-group"data-bs-toggle="tooltip" data-bs-placement="top" title="Buscar por ID y estado">
                                            <span class="input-group-text bg-white border-0 border-bottom">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text" name="search" class="form-control border-0 border-bottom"
                                                placeholder="Buscar por ID y estado..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                    
                                    <!-- Filtro de tiempo -->
                                    <div class="col-md-6">
                                        <select name="time_filter" class="form-select border-0 border-bottom" onchange="this.form.submit()">
                                            <option value="">Todos los registros</option>
                                            <option value="today" {{ request('time_filter') == 'today' ? 'selected' : '' }}>Hoy</option>
                                            <option value="this_week" {{ request('time_filter') == 'this_week' ? 'selected' : '' }}>Esta semana</option>
                                            <option value="this_month" {{ request('time_filter') == 'this_month' ? 'selected' : '' }}>Este mes</option>
                                            <option value="last_week" {{ request('time_filter') == 'last_week' ? 'selected' : '' }}>Semana pasada</option>
                                            <option value="last_month" {{ request('time_filter') == 'last_month' ? 'selected' : '' }}>Mes pasado</option>
                                            <option value="last_3_months" {{ request('time_filter') == 'last_3_months' ? 'selected' : '' }}>Últimos 3 meses</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Botón Agregar en tabla -->
                        <div class="col-12 col-md-3 text-md-end">
                            <a href="{{ route('estatus_equipos') }}" class="btn btn-secondary me-md-2">
                                Limpiar
                            </a>
                            <button class="btn" data-bs-toggle="modal" data-bs-target="#modalAñadir"
                                style="background-color: #222944; color: white; border-color:#222944;">
                                Agregar
                            </button>
                        </div>
                    </div>

                    <!-- Tabla de estatus de equipo -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="border-0 border-bottom-0">
                                <tr>
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table">
                                @forelse($estatusEquipos as $estatusEquipo)
                                    <tr>
                                        <td>{{ $estatusEquipo->id }}</td>
                                        <td>{{ $estatusEquipo->estado }}</td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Botón Editar -->
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditar{{ $estatusEquipo->id }}"
                                                    style="color: #222944">
                                                    <i class="bi bi-pencil-square fs-5"></i>
                                                </button>

                                                <!-- Botón Eliminar -->
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar{{ $estatusEquipo->id }}"
                                                    style="color: #cf0a2c">
                                                    <i class="bi bi-trash fs-5"></i>
                                                </button>

                                                <!-- Botón Ver -->
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#modalVer{{ $estatusEquipo->id }}"
                                                    style="color: #212121">
                                                    <i class="bi bi-eye fs-5"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No se encontraron estados de equipo</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Contenedor inferior de tabla -->
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                        <span class="text-bling fw-bold p-3" style="color: #222944">
                            Mostrando del {{ $estatusEquipos->firstItem() }} al {{ $estatusEquipos->lastItem() }} de {{ $estatusEquipos->total() }} Estados
                        </span>

                        <!-- Botón para Importar Información -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn" style="background-color: #222944; color: white; border-color:#222944" data-bs-toggle="modal" data-bs-target="#importModal">
                                    Importar Información
                                </button>

                                <!-- Botón para  Exportar información -->
                                <button class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                    Exportar información
                                </button>
                           </div>
                    </div>

                    <!-- Modal -->
                        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="{{ route('estatus_equipos.importar') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                    @csrf
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="importModalLabel">Importar archivo Excel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                    <input type="file" name="archivo_excel" class="form-control w-auto" required>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success" style="background-color: #222944; color: white; border-color:#222944">Importar Excel</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
    

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center mt-3 pagination-container">
                        {{ $estatusEquipos->appends([
                            'per_page' => request('per_page'),
                            'search' => request('search'),
                            'time_filter' => request('time_filter')
                        ])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Modal de Añadir -->
    @include('Dashboard.EstatusEquipo.Modales.agregar')

        <!-- Modales por estatusEquipo -->
        @foreach($estatusEquipos as $estatusEquipo)
            
        <!-- Modal de Editar -->
        @include('Dashboard.EstatusEquipo.Modales.editar')

        <!-- Modal de Eliminar -->
        @include('Dashboard.EstatusEquipo.Modales.eliminar')

        <!-- Modal Ver -->
        @include('Dashboard.EstatusEquipo.Modales.ver')



@endforeach

@push('scripts')
<script>
    // Función para el selector de entradas
    function changeEntries(select) {
        const perPage = select.value;
        const url = new URL(window.location.href);

        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    }

    // Enviar formulario en Enter para búsqueda
    document.querySelector('.input-group input').addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            this.form.submit();
        }
    });
</script>
@endpush
@endsection