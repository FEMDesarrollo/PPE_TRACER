<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block">PPE TRACER</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <!-- Notificaciones -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">4</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
              <h4>Lorem Ipsum</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>30 min. ago</p>
            </div>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li class="notification-item">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
              <h4>Atque rerum nesciunt</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>1 hr. ago</p>
            </div>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li class="notification-item">
            <i class="bi bi-check-circle text-success"></i>
            <div>
              <h4>Sit rerum fuga</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>2 hrs. ago</p>
            </div>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
              <h4>Dicta reprehenderit</h4>
              <p>Quae dolorem earum veritatis oditseno</p>
              <p>4 hrs. ago</p>
            </div>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>
        </ul>
      </li>

      <!-- Perfil de usuario -->
      <li class="nav-item dropdown pe-3">
        @if(Auth::check())
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img
            src="{{ Auth::user()->foto
              ? asset('storage/' . Auth::user()->foto)
              : asset('assets/img/profile-img.jpg') }}"
            alt="Profile"
            class="rounded-circle"
            style="width: 40px; height: 40px; object-fit: cover;">
          <span class="d-none d-md-block dropdown-toggle ps-2">
            {{ Auth::user()->nombre }} {{ Auth::user()->app }}
          </span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ Auth::user()->nombre_completo }}</h6>
            <span>{{ Auth::user()->perfil->nombre }}</span>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#perfilOffcanvas">
              <i class="bi bi-person"></i>
              <span>Mi Perfil</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Configuración</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Necesitas ayuda?</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="/logout">
              <i class="bi bi-box-arrow-right"></i>
              <span>Cerrar sesión</span>
            </a>
          </li>
        </ul>
        @endif
      </li>
    </ul>
  </nav>

  <!-- Offcanvas perfil -->

  <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="perfilOffcanvas" aria-labelledby="perfilOffcanvasLabel" style="width: 380px; background: #fff; color: #222944; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="offcanvas-header border-bottom" style="border-color: #ddd;">
      <h5 class="offcanvas-title fw-bold d-flex align-items-center" id="perfilOffcanvasLabel" style="color: #222944;">
      Mi Perfil
      </h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body px-4 pt-3">
      <div class="text-center mb-4">
        <form action="{{ route('cambiar_foto', ['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data" style="display: inline-block;">
          @csrf
          @method('PUT')
          <label for="foto" class="profile-pic-wrapper" title="Cambiar foto de perfil">
            <img  src="{{ Auth::user()->foto
                ? asset('storage/' . Auth::user()->foto)
                : asset('assets/img/profile-img.jpg') }}"  alt="Foto de perfil" />
            <span class="camera-icon">
              <i class="bi bi-camera"></i>
            </span>
          </label>
          <input type="file" id="foto" name="foto" accept="image/*" onchange="this.form.submit()" />
        </form>
      </div>
      <div class="text-center mb-5">
        <h6 class="mt-0 mb-1 fw-semibold" style="color: #222944;">{{ Auth::user()->nombre }}</h6>
        <small class="text-muted" style="font-size: 0.9rem;">{{ Auth::user()->rol ?? 'Usuario' }}</small>
      </div>
      <div class="card border-0 shadow-sm" style="background-color: #f9fafb; border-radius: 12px;">
        <ul class="list-group list-group-flush rounded-3">
          <li class="list-group-item px-4 py-3" style="background-color: #f9fafb; border-bottom: 1px solid #e4e7eb;">
            <strong style="color: #222944;">Correo:</strong>
            <p class="mb-0" style="color: #555;">{{ Auth::user()->correo }}</p>
          </li>
          <li class="list-group-item px-4 py-3" style="background-color: #f9fafb; border-radius: 0 0 12px 12px;">
            <strong style="color: #222944;">Fecha de registro:</strong>
            <p class="mb-0" style="color: #555;">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
          </li>
        </ul>
      </div>
      <div class="mt-5 text-center">
        <button class="btn btn-dark w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm rounded-pill"
          style="background-color: #222944; border: none; box-shadow: 0 4px 12px rgb(34 41 68 / 0.3);"
          data-bs-dismiss="offcanvas" style="background-color: #222944; border: none;">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</header>
