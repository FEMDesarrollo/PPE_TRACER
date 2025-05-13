<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('/dashboard') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Panel Administrativo</span>
            </a>
        </li>
        @foreach ($Permisos as $Permiso)
        @php 
        $menuId = 'menu-' . $Permiso->id;
        @endphp
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#{{ $menuId }}" data-bs-toggle="collapse">
                <i class="{{ $Permiso->icono}}"></i>{{ $Permiso->permiso }}<i class="bi bi-chevron-down ms-auto"></i>
            </a>
            @if ($Permiso->submenus->isNotEmpty())
            <ul id="{{ $menuId }}" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @foreach ($Permiso->submenus as $submenu)
                <li>
                    <a href="{{ url($submenu->url) }}">
                        <span>{{ $submenu->permiso }}</span>
                      </a>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>

    <div class="col-12 ">
        <button class="" 
            style="background-color: #222944; color: white; border-color:#222944;">Generar Reporte</button>
    </div>
</aside>
