@extends('Layouts.app')
@section('title', 'PPE TRACER')
@section('page_title', 'PANEL ADMINISTRATIVO')
@section('subtitle', 'Equipos de subestación')
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
                                <form method="GET" action="{{ route('subestacion_equipos') }}" id="entriesForm">
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
                                <form method="GET" action="{{ route('subestacion_equipos') }}">
                                    <div class="row g-2">
                                        <!-- Buscador -->
                                        <div class="col-md-6">
                                            <div class="input-group" data-bs-toggle="tooltip" data-bs-placement="top" title="Buscar por ID, número de traje, equipo, estación o subestación">
                                                <span class="input-group-text bg-white border-0 border-bottom">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" name="search" class="form-control border-0 border-bottom"
                                                    placeholder="Buscar por ID, número de traje, equipo, estación o subestación" value="{{ request('search') }}">
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
                                <a href="{{ route('subestacion_equipos') }}" class="btn btn-secondary me-md-2">
                                    Limpiar
                                </a>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#modalAñadir"
                                    style="background-color: #222944; color: white; border-color:#222944;">
                                    Agregar
                                </button>
                            </div>
                        </div>

                        <!-- Tabla de equipos de subestación -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="border-0 border-bottom-0">
                                    <tr>
                                        <th>ID</th>
                                        <th>No_Traje</th>
                                        <th>Equipo</th>
                                        <th>Estación</th>
                                        <th>SubEstación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table">
                                    @forelse($subestacionEquipos as $subEE)
                                        <tr>
                                            <td>{{ $subEE->id }}</td>
                                            <td>{{ $subEE->no_traje }}</td>
                                            <td>{{ $subEE->equipo->equipo }}</td>
                                            <td>{{ $subEE->estacion->nombre ?? 'Sin estación' }}</td>
                                            <td>{{ $subEE->subestacion->nombre ?? 'Sin subestacion' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- Botón Editar -->
                                                    <button type="button" class="btn" data-bs-toggle="modal" 
                                                        data-bs-target="#modalEditar{{ $subEE->id }}" 
                                                        style="color: #222944">
                                                        <i class="bi bi-pencil-square fs-5"></i>
                                                    </button>

                                                    <!-- Botón Eliminar -->
                                                    <button type="button" class="btn" data-bs-toggle="modal" 
                                                        data-bs-target="#modalEliminar{{ $subEE->id }}" 
                                                        style="color: #cf0a2c">
                                                        <i class="bi bi-trash fs-5"></i>
                                                    </button>

                                                    <!-- Botón Ver -->
                                                    <button type="button" class="btn" data-bs-toggle="modal" 
                                                        data-bs-target="#modalVer{{ $subEE->id }}" 
                                                        style="color: #212121">
                                                        <i class="bi bi-eye fs-5"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No se encontraron equipos de subestación</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Contenedor inferior de tabla -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                            <!-- Mostrando equipos -->
                            <span class="text-bling fw-bold p-3" style="color: #222944">
                                Mostrando del {{ $subestacionEquipos->firstItem() }} al {{ $subestacionEquipos->lastItem() }} de {{ $subestacionEquipos->total() }} Equipos
                            </span>
                            
                            <!-- Botón Exportar de tabla -->
                            <button class="btn" style="background-color: #222944; color: white; border-color:#222944">
                                Exportar información
                            </button>
                        </div>

                        <!-- Paginación -->
                        <div class="d-flex justify-content-center mt-3 pagination-container">
                            {{ $subestacionEquipos->appends([
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
    @include('Dashboard.SubestacionEquipos.modales.agregar')

    <!-- Modals para cada equipo -->
    @foreach($subestacionEquipos as $subEE)
        <!-- Modal de Editar -->
        @include('Dashboard.SubestacionEquipos.modales.editar')

        <!-- Modal de Eliminar -->
        @include('Dashboard.SubestacionEquipos.modales.eliminar')

        <!-- Modal Ver -->
        @include('Dashboard.SubestacionEquipos.modales.ver')
    @endforeach

    @push('scripts')
    <script>
        function changeEntries(select) {
            const perPage = select.value;
            const url = new URL(window.location.href);
            
            // Actualiza el parámetro per_page en la URL
            url.searchParams.set('per_page', perPage);
            
            // Recarga la página con el nuevo parámetro
            window.location.href = url.toString();
        }

        // Función para el buscador
        document.querySelector('.input-group input').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });

        // Mostrar modal automáticamente si hay error de validación
        @if($errors->any() || session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalAñadir'));
                modal.show();
            });
        @endif
    </script>
    @endpush
    
@endsection