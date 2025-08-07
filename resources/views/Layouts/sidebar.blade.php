<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-administrador" data-bs-toggle="collapse">
                <i class="bi bi-menu-button-wide"></i><span>Panel Administrativo</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-administrador" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    {{-- CAMBIO: Usamos Auth::user()->id_perfil --}}
                    @if(Auth::user()->id_perfil == 1)
                        <a href="{{ route('verificacion_correo') }}"><span>Verificación de correo</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Verificación de correo</span></a>
                    @endif
                </li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('permisos_usuarios') }}"><span>Permisos de usuarios</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Permisos de usuarios</span></a>
                    @endif
                </li>
                <li>
                    @if(Auth::user()->id_perfil == 1)
                        <a href="{{ route('permisos') }}"><span>Permisos</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Permisos</span></a>
                    @endif
                </li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1]))
                        <a href="{{ route('perfiles') }}"><span>Perfiles</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Perfiles</span></a>
                    @endif
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-usuarios" data-bs-toggle="collapse">
                <i class="bi bi-people"></i><span>Gestión de usuarios</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-usuarios" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('usuarios_equipos') }}"><span>Responsable de equipo</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Responsable de equipo</span></a>
                    @endif
                </li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('usuarios') }}"><span>Usuarios</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Usuarios</span></a>
                    @endif
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-proveedores" data-bs-toggle="collapse">
                <i class="bi bi-truck"></i><span>Gestión proveedores</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-proveedores" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                @if(in_array(Auth::user()->id_perfil, [1, 2]))
                    <li><a href="{{ route('proveedores') }}"><span>Proveedores</span></a></li>
                    <li><a href="{{ route('servicios') }}"><span>Servicios</span></a></li>
                    <li><a href="{{ route('proveedor_servicios') }}"><span>Servicios de proveedores</span></a></li>
                @else
                    <li><a class="link-deshabilitado"><span>Proveedores</span></a></li>
                    <li><a class="link-deshabilitado"><span>Servicios</span></a></li>
                    <li><a class="link-deshabilitado"><span>Servicios de proveedores</span></a></li>
                @endif
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-equipos" data-bs-toggle="collapse">
                <i class="bi bi-tools"></i><span>Gestión de equipos</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-equipos" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                {{-- Estas rutas son para todos, no necesitan condición --}}
                <li><a href="{{ route('accesorios') }}"><span>Accesorios</span></a></li>
                <li><a href="{{ route('categorias') }}"><span>Categorías</span></a></li>
                <li><a href="{{ route('detalles_equipos') }}"><span>Detalles del equipo</span></a></li>
                <li><a href="{{ route('equipos') }}"><span>Equipos</span></a></li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('subestacion_equipos') }}"><span>Equipos de subestación</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Equipos de subestación</span></a>
                    @endif
                </li>
                <li><a href="{{ route('detalles_estatus') }}"><span>Estado detallado</span></a></li>
                <li><a href="{{ route('repuestos') }}"><span>Repuestos</span></a></li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('usuarios_equipos') }}"><span>Usuarios de equipos</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Usuarios de equipos</span></a>
                    @endif
                </li>
                <li><a href="{{ route('estatus_equipos') }}"><span>Estatus de equipos</span></a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-infraestructura" data-bs-toggle="collapse">
                <i class="bi bi-building"></i><span>Infraestructura</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-infraestructura" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('estaciones') }}"><span>Estación</span></a></li>
                <li><a href="{{ route('subestaciones') }}"><span>Subestación</span></a></li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('estacion_proveedores') }}"><span>Estación de proveedores</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Estación de proveedores</span></a>
                    @endif
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#menu-inspecciones" data-bs-toggle="collapse">
                <i class="bi bi-clipboard-check"></i><span>Gestión de inspecciones</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="menu-inspecciones" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('control_inspecciones') }}"><span>Control de inspecciones</span></a></li>
                <li><a href="{{ route('gestion_inspecciones') }}"><span>Gestión de inspecciones</span></a></li>
                <li><a href="{{ route('control_asignaciones') }}"><span>Control de asignaciones</span></a></li>
                <li>
                    @if(in_array(Auth::user()->id_perfil, [1, 2]))
                        <a href="{{ route('estatus_critico') }}"><span>Estatus Crítico</span></a>
                    @else
                        <a class="link-deshabilitado"><span>Estatus Crítico</span></a>
                    @endif
                </li>
            </ul>
        </li>
    </ul>
    
    <div class="col-12 mt-4 px-3">
        <button class="btn btn-dark w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm rounded-pill" style="background-color: #222944; border: none;">
            <i class="bi bi-file-earmark-bar-graph"></i>
            <span>Generar Reporte</span>
        </button>
    </div>
</aside>