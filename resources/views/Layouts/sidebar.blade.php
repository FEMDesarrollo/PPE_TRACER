<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Panel Administrativo Principal -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-administrador" data-bs-toggle="collapse">
                <i class="bi bi-menu-button-wide"></i>
                <span>Panel Administrativo</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-administrador" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/verificacion_correo') }}">
                        <span>Verificación de correo</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/permisos_usuarios') }}">
                        <span>Permisos de usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/permisos') }}">
                        <span>Permisos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/perfiles') }}">
                        <span>Perfiles</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Gestión de Usuarios -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-usuarios" data-bs-toggle="collapse">
                <i class="bi bi-people"></i>
                <span>Gestión de usuarios</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-usuarios" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/responsable-equipo') }}">
                        <span>Responsable de equipo</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/usuarios') }}">
                        <span>Usuarios</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Gestión de Proveedores -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-proveedores" data-bs-toggle="collapse">
                <i class="bi bi-truck"></i>
                <span>Gestión proveedores</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-proveedores" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/proveedores') }}">
                        <span>Proveedores</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/servicios') }}">
                        <span>Servicios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/proveedor_servicios') }}">
                        <span>Servicios de proveedores</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Gestión de Equipos -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-equipos" data-bs-toggle="collapse">
                <i class="bi bi-tools"></i>
                <span>Gestión de equipos</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-equipos" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/accesorios') }}">
                        <span>Accesorios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/categorias') }}">
                        <span>Categorías</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/detalles_equipos') }}">
                        <span>Detalles del equipo</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/equipos') }}">
                        <span>Equipos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/subestacion_equipos') }}">
                        <span>Equipos de subestación</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/detalles_estatus') }}">
                        <span>Estado detallado</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/repuestos') }}">
                        <span>Repuestos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/usuarios_equipos') }}">
                        <span>Usuarios de equipos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/estatus_equipos') }}">
                        <span>Estatus de equipos</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Infraestructura -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-infraestructura" data-bs-toggle="collapse">
                <i class="bi bi-building"></i>
                <span>Infraestructura</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-infraestructura" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/estaciones') }}">
                        <span>Estación</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/subestaciones') }}">
                        <span>Subestación</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/estacion_proveedores') }}">
                        <span>Estación de proveedores</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Inspecciones -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-inspecciones" data-bs-toggle="collapse">
                <i class="bi bi-clipboard-check"></i>
                <span>Gestión de inspecciones</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-inspecciones" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('/control_inspecciones') }}">
                        <span>Control de inspecciones</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/gestion_inspecciones') }}">
                        <span>Gestión de inspecciones</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/control_asignaciones') }}">
                        <span>Control de asignaciones</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/estatus_critico') }}">
                        <span>Estatus Crítico</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- Botón Generar Reporte -->
    <div class="col-12 mt-4 px-3">
    <button class="btn btn-dark w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm rounded-pill btn-reporte" style="background-color: #222944; border: none;">
        <i class="bi bi-file-earmark-bar-graph"></i>
        <span>Generar Reporte</span>
    </button>
</div>
</aside>



