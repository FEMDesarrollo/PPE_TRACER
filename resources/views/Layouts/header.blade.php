@include('components.reedirecciones del offcanvas.offcanvas')
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
  <i class="bi bi-list toggle-sidebar-btn me-3"></i>
    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
      <span class="nav-link dropdown active">PPE TRACER</span>
    </a>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <!-- Notificaciones -->
      <li class="nav-item dropdown">
    {{-- Icono de campana --}}
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        @if(isset($notificaciones) && $notificaciones->count() > 0)
            <span class="badge bg-primary badge-number">{{ $notificaciones->count() }}</span>
        @endif
    </a>

    {{-- Dropdown de notificaciones --}}
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            Tienes {{ $notificaciones->count() }} notificaciones
            @if($notificaciones->count() > 0)
                <a href="{{ route('notificaciones.limpiar') }}">
                    <span class="badge rounded-pill bg-danger p-2 ms-2">Limpiar</span>
                </a>
            @endif
        </li>

        <li><hr class="dropdown-divider"></li>

        @forelse($notificaciones as $n)
            <li class="notification-item">
                <i class="{{ $n->icono }}"></i>
                <div>
                    <h4>{{ $n->titulo }}</h4>
                    <p>{{ $n->mensaje }}</p>
                    <p class="small text-muted">{{ $n->created_at->diffForHumans() }}</p>
                </div>
            </li>
            <li><hr class="dropdown-divider"></li>
        @empty
            <li class="notification-item text-center">
                <p>No tienes notificaciones</p>
            </li>
        @endforelse
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
            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#configuracionOffcanvas">
              <i class="bi bi-gear"></i>
              <span>Configuración</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#ayudaOffcanvas">
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
            <strong style="color: #222944;">Identificación de usuario:</strong>
            <p class="mb-0" style="color: #555;">{{ Auth::user()->id }}</p>
          </li>
          <li class="list-group-item px-4 py-3" style="background-color: #f9fafb; border-radius: 0 0 12px 12px;">
            <strong style="color: #222944;">Estación:</strong>
            <p class="mb-0" style="color: #555;">{{ Auth::user()->estacion->nombre }}</p>
          </li>
          <li class="list-group-item px-4 py-3" style="background-color: #f9fafb; border-radius: 0 0 12px 12px;">
            <strong style="color: #222944;">Subestación:</strong>
            <p class="mb-0" style="color: #555;">{{ Auth::user()->subEstacion->nombre }}</p>
          </li>
          <li class="list-group-item px-4 py-3" style="background-color: #f9fafb; border-bottom: 1px solid #e4e7eb;">
            <strong style="color: #222944;">Correo:</strong>
            <p class="mb-0" style="color: #555;">{{ Auth::user()->correo }}</p>
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

  <!-- Offcanvas Configuración -->
  <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="configuracionOffcanvas" aria-labelledby="configuracionOffcanvasLabel"
    style="width: 380px; background: #fff; color: #222944; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="offcanvas-header border-bottom" style="border-color: #ddd;">
      <h5 class="offcanvas-title fw-bold" id="configuracionOffcanvasLabel">Configuración</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>

    <div class="offcanvas-body px-4 pt-3">

      <!-- Tabs -->
      <ul class="nav nav-tabs mb-3" id="configTabs" role="tablist" style="border-bottom: 2px solid #222944;">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="datos-tab" data-bs-toggle="tab" data-bs-target="#datos" type="button" role="tab" aria-controls="datos" aria-selected="true">
            Datos personales
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="seguridad-tab" data-bs-toggle="tab" data-bs-target="#seguridad" type="button" role="tab" aria-controls="seguridad" aria-selected="false">
            Seguridad
          </button>
        </li>
      </ul>

      <!-- Mensaje de éxito (mensaje verde) de forma global-->
      @include('components.alertas de cruds.alerts')

      <!-- Contenido de pestañas -->
      <div class="tab-content" id="configTabsContent">

        <!-- DATOS PERSONALES -->
        <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
          <form action="{{ route('datos_personales', ['id' => Auth::user()->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="modal" value="configuracion">
            <input type="hidden" name="activeTab" value="datos">


            <div class="mb-3 form-floating">
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="Nombre" value="{{ old('nombre', Auth::user()->nombre) }}">
              <label for="nombre">Nombre</label>
              @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-floating">
              <input type="text" class="form-control @error('app') is-invalid @enderror" name="app" id="app" placeholder="Apellido paterno" value="{{ old('app', Auth::user()->app) }}">
              <label for="app">Apellido paterno</label>
              @error('app') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-floating">
              <input type="text" class="form-control @error('apm') is-invalid @enderror" name="apm" id="apm" placeholder="Apellido materno" value="{{ old('apm', Auth::user()->apm) }}">
              <label for="apm">Apellido materno</label>
              @error('apm') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-floating">
              <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" placeholder="Teléfono" value="{{ old('telefono', Auth::user()->telefono) }}">
              <label for="telefono">Teléfono</label>
              @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="offcanvas">Cancelar</button>
              <button type="submit" class="btn btn-dark rounded-pill px-4" style="background-color: #222944;">Guardar cambios</button>
            </div>
          </form>
        </div>

        <!-- SEGURIDAD -->
        <div class="tab-pane fade" id="seguridad" role="tabpanel" aria-labelledby="seguridad-tab">
          <form action="{{ route('cambiar_password', ['id' => Auth::user()->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="modal" value="configuracion">
            <input type="hidden" name="activeTab" value="seguridad">


            <div class="mb-3 form-floating">
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Contraseña actual">
              <label for="password">Contraseña actual</label>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-floating">
              <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="Nueva contraseña">
              <label for="new_password">Nueva contraseña</label>
              @error('new_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 form-floating">
              <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirmar nueva contraseña">
              <label for="new_password_confirmation">Confirmar nueva contraseña</label>
              @error('new_password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="offcanvas">Cancelar</button>
              <button type="submit" class="btn btn-dark rounded-pill px-4" style="background-color: #222944;">Cambiar contraseña</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>


  <!-- Offcanvas Ayuda -->
  <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="ayudaOffcanvas" aria-labelledby="ayudaOffcanvasLabel" style="width: 380px; background: #fff; color: #222944; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="offcanvas-header border-bottom" style="border-color: #ddd;">
      <h5 class="offcanvas-title fw-bold d-flex align-items-center" id="ayudaOffcanvasLabel">¿Necesitas ayuda?</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body px-4 pt-3">
      <div class="accordion" id="faqAccordion">
        <div class="accordion-item mb-3">
          <h2 class="accordion-header" id="faq1">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1">
              ¿Cómo ingreso al sistema?
            </button>
          </h2>
          <div id="faqCollapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Debes ingresar tu correo y contraseña previamente registrados por el administrador.</div>
          </div>
        </div>
        <div class="accordion-item mb-3">
          <h2 class="accordion-header" id="faq2">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2">
              ¿Cómo cambio mi nombre?
            </button>
          </h2>
          <div id="faqCollapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Desde el apartado de Configuración, puedes cambiar tus datos personales.</div>
          </div>
        </div>
        <div class="accordion-item mb-3">
          <h2 class="accordion-header" id="faq3">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3">
              ¿Cómo cambio mi contraseña?
            </button>
          </h2>
          <div id="faqCollapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Ve a Configuración → Seguridad → Cambiar contraseña.</div>
          </div>
        </div>
        <div class="accordion-item mb-3">
          <h2 class="accordion-header" id="faq4">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4">
              ¿Cómo cambiar la foto de perfil?
            </button>
          </h2>
          <div id="faqCollapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Desde el apartado “Mi Perfil”, da clic sobre tu imagen y selecciona una nueva foto.</div>
          </div>
        </div>
        <div class="accordion-item mb-3">
          <h2 class="accordion-header" id="faq5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5">
              ¿Cómo registrarme?
            </button>
          </h2>
          <div id="faqCollapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">El registro es gestionado por el administrador del sistema.</div>
          </div>
        </div>

        <div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq6">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6">
      ¿Por qué no puedo guardar mis cambios al editar mis datos?
    </button>
  </h2>
  <div id="faqCollapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Asegúrate de que los campos obligatorios estén completos y cumplan con las reglas de validación, como el formato correcto y la longitud mínima. Además, si dejas vacío el campo de contraseña, no cambiará tu contraseña actual.
    </div>
  </div>
</div>

<div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq7">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse7">
      ¿Por qué la contraseña es opcional al editar mi perfil?
    </button>
  </h2>
  <div id="faqCollapse7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Para mayor comodidad, la contraseña solo es requerida cuando creas un nuevo usuario. Al editar, puedes dejarla vacía para no cambiarla. Si quieres actualizarla, solo escribe la nueva contraseña.
    </div>
  </div>
</div>

<div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq8">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse8">
      ¿Qué campos puedo editar en la configuración?
    </button>
  </h2>
  <div id="faqCollapse8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Puedes cambiar tu nombre, apellido paterno, apellido materno, teléfono y contraseña desde el apartado Configuración. Otros datos como correo o perfil deben modificarse desde otras opciones o por un administrador.
    </div>
  </div>
</div>

<div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq9">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse9">
      ¿Cómo afecta la validación al guardar mis datos?
    </button>
  </h2>
  <div id="faqCollapse9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Las validaciones garantizan que la información ingresada sea correcta y segura. Por ejemplo, el teléfono debe tener un formato válido y la contraseña cumplir con la longitud mínima. Si no pasas la validación, el sistema no guardará los cambios.
    </div>
  </div>
</div>

<div class="accordion-item mb-3">
  <h2 class="accordion-header" id="faq10">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse10">
      ¿Por qué no puedo cambiar mi correo electrónico desde la configuración?
    </button>
  </h2>
  <div id="faqCollapse10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
    <div class="accordion-body">
      Por seguridad, el cambio de correo electrónico está restringido y generalmente solo puede hacerlo un administrador. Esto evita problemas con el acceso y notificaciones del sistema.
    </div>
  </div>
</div>

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



