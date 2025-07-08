<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPE TRACER</title>
  <!-- Favicons -->
  {{-- <link href="assets/img/favicon.png" rel="icon"> --}}
  <link href="{{ asset('img/logotipo.png') }}" rel="icon">
  <!-- AOS (Animate On Scroll) CSS para animaciones en desplazamiento -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- AOS JS para inicializar y manejar animaciones en desplazamiento -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

  <!-- Bootstrap 5 CSS para diseño responsivo y estilos predefinidos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- FontAwesome para iconos personalizados -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <!-- Google Fonts: Montserrat para tipografía personalizada -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap Icons para iconos adicionales de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />

  <!-- Estilos CSS personalizados para la página informativa -->
  <link href="assets/css/home.css" rel="stylesheet">

  <!-- jQuery 3.6.0 para manipulación del DOM y funcionalidades JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap 5 JS para funcionalidades como modales, carruseles y tooltips -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script personalizado para la página informativa -->
  <script src="assets/js/home.js" defer></script>

<body>
  <!-- Navbar  -->
  <nav class="navbar navbar-expand-lg transparent">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('img/logow.png') }}" alt="Logo" style="width: 21%; height: auto;" />
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span
          class="navbar-toggler-icon"
          style="
            background-image: url('data:image/svg+xml;charset=UTF8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'30\' height=\'30\' viewBox=\'0 0 30 30\'><path stroke=\'rgba(255,255,255,1)\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' d=\'M4 7h22M4 15h22M4 23h22\'/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            width: 30px;
            height: 30px;">
        </span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">INICIO</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              SOBRE EL SISTEMA
            </a>
            <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#section1">Desafío</a></li>
              <li><a class="dropdown-item" href="#section2">Seguimiento</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Seccion Inicio -->
  <div class="hero-content" id="inicio">
    <div class="hero-image"></div>
    <div class="hero-text mt-5">
      <h1 class="title mt-5">
        SISTEMA PARA LA ADMINISTRACIÓN DE INVENTARIOS DE EQUIPOS DE BOMBERO
      </h1>
      <div class="red-line h-2 w-70 my-5" style="max-width: 600px;"></div>
      <p class="subtitle">Control eficiente, operaciones confiables.</p>
     <div class="btn-container mt-5">
  <a href="..\login" 
     class="btn mx-auto text-decoration-none py-2 px-4" 
     style="
       background-color: #cf0a2c; 
       color: white; 
       border: none; 
       border-radius: 30px; 
       font-weight: 600; 
       font-family: 'Montserrat', sans-serif; 
       text-transform: uppercase; 
       letter-spacing: 0.5px; 
       transition: all 0.3s ease; 
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
       min-width: 180px;
     ">
    Iniciar sesión
  </a>
</div>
    </div>
  </div>

  <!-- Seccion Desafio -->
  <section id="section1" class="section bg-white mb-5">
    <div class="container mt-5 mb-1">
      <h2 class="section-title semibold mt-5" data-aos="slide-left">Desafío</h2>
      <p class="mb-5" data-aos="slide-left" data-aos-delay="100">
        Los cuerpos de bomberos enfrentan desafíos en la administración de
        equipos esenciales para su seguridad.
      </p>

      <div class="row">
        <div class="col-md-6 mb-4" data-aos="slide-left" data-aos-delay="150">
          <div class="challenge-item">
            <h3 class="semibold">Problemas de control</h3>
            <p class="regular">
              Sin un sistema digital, el control del inventario es
              ineficiente.
            </p>
          </div>
        </div>
        <div class="col-md-6 mb-4" data-aos="slide-left" data-aos-delay="200">
          <div class="challenge-item">
            <h3 class="semibold">Normativa NFPA 1851</h3>
            <p class="regular">
              Dificultad para garantizar el cumplimiento de los estándares de
              seguridad.
            </p>
          </div>
        </div>
        <div class="col-md-6 mb-4" data-aos="slide-left" data-aos-delay="250">
          <div class="challenge-item">
            <h3 class="semibold">Errores en Registros</h3>
            <p class="regular">
              Las inspecciones manuales aumentan el riesgo de fallos en los
              equipos.
            </p>
          </div>
        </div>
        <div class="col-md-6 mb-4" data-aos="slide-left" data-aos-delay="300">
          <div class="challenge-item">
            <h3 class="semibold">Asignación ineficiente</h3>
            <p class="regular">
              Distribución incorrecta de equipos que afecta su disponibilidad.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seccion Seguimiento -->
  <section id="section2" class="section seguimiento-section py-5">
    <div class="container mt-5 mb-1">
      <h2 class="section-title mb-4">Seguimiento</h2>
      <div class="row g-3 g-md-4 justify-content-center mt-5">
        <!-- Registro de tu EPP -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
          <div class="tracking-item">
            <div class="tracking-header d-flex align-items-center mb-2 mb-md-3">
              <div class="tracking-icon me-3">
                <img src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/icons/clipboard-data.svg" alt="Registro" width="40" height="40" class="img-fluid">
              </div>
              <h3 class="tracking-title fw-bold mb-0">Registro de tu EPP</h3>
            </div>
            <div class="tracking-content">
              <ul class="tracking-list">
                <li>Registra la información básica.</li>
                <li>Vincúlalo a un usuario o área.</li>
                <li>Indica la adquisición y duración estimada.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Monitoreo -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
          <div class="tracking-item">
            <div class="tracking-header d-flex align-items-center mb-2 mb-md-3">
              <div class="tracking-icon me-3">
                <img src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/icons/person-workspace.svg" alt="Monitoreo" width="40" height="40" class="img-fluid">
              </div>
              <h3 class="tracking-title fw-bold mb-0">Monitoreo</h3>
            </div>
            <div class="tracking-content">
              <ul class="tracking-list">
                <li>Consulta en tiempo real.</li>
                <li>Revisa mantenimiento e inspecciones.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Revisión de tu EPP -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
          <div class="tracking-item">
            <div class="tracking-header d-flex align-items-center mb-2 mb-md-3">
              <div class="tracking-icon me-3">
                <img src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/icons/clipboard-check.svg" alt="Revisión" width="40" height="40" class="img-fluid">
              </div>
              <h3 class="tracking-title fw-bold mb-0">Revisión de tu EPP</h3>
            </div>
            <div class="tracking-content">
              <ul class="tracking-list">
                <li><strong>Rutinaria:</strong> Inspecciones periódicas básicas.</li>
                <li><strong>Avanzada:</strong> Evaluaciones más detalladas y técnicas.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Alertas -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
          <div class="tracking-item">
            <div class="tracking-header d-flex align-items-center mb-2 mb-md-3">
              <div class="tracking-icon me-3">
                <img src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/icons/bell.svg" alt="Alertas" width="40" height="40" class="img-fluid">
              </div>
              <h3 class="tracking-title fw-bold mb-0">Alertas</h3>
            </div>
            <div class="tracking-content">
              <ul class="tracking-list">
                <li>Alerta sobre el estado del equipo.</li>
                <li>Avisos para inspecciones y mantenimiento.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Acciones finales -->
        <div class="col-12 col-sm-6 col-md-4 mb-3">
          <div class="tracking-item">
            <div class="tracking-header d-flex align-items-center mb-2 mb-md-3">
              <div class="tracking-icon me-3">
                <img src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/icons/graph-up.svg" alt="Acciones" width="40" height="40" class="img-fluid">
              </div>
              <h3 class="tracking-title fw-bold mb-0">Acciones finales</h3>
            </div>
            <div class="tracking-content">
              <ul class="tracking-list">
                <li>Reporte de condiciones finales del equipo.</li>
                <li>Opción para dar de baja o reasignar el EPP según su estado.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Icono de regresar al inico -->
  <a href="#inicio" id="backToTop" class="position-fixed bottom-0 end-0 m-4"
    style="
        display: none;
        width: 50px;
        height: 50px;
        text-align: center;
    ">
    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="12" y1="19" x2="12" y2="5"></line>
      <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
  </a>
</body>

<!-- Pie de pagina -->
<footer class="bg-dark text-white py-4">
  <div class="container">
    <!-- Sección principal -->
    <div class="row">
      <!-- PPE TRACER -->
      <div class="col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase fw-bold mb-3">
          <i class="bi bi-shield-check text-danger me-2"></i>PPE TRACER
        </h5>
        <p class="small text-light">
          Sistema especializado en la administración de inventarios para
          equipos de protección de bomberos. Optimizando la gestión de
          recursos críticos para mayor seguridad y eficiencia.
        </p>
      </div>

      <!-- Información de contacto -->
      <div class="col-md-6 mb-0">
        <h6 class="fw-bold mb-3">Contacto y Soporte</h6>
        <div class="row">
          <div class="col-sm-6 mb-2">
            <i class="bi bi-telephone-fill text-danger me-2"></i>
            <span class="small">(555) 233-4567</span>
          </div>
          <div class="col-sm-6 mb-2">
            <i class="bi bi-envelope-fill text-danger me-2"></i>
            <span class="small">soporte@ppetracer.com</span>
          </div>
          <div class="col-sm-6">
            <i class="bi bi-headset text-danger me-2"></i>
            <span class="small">Asistencia técnica</span>
          </div>
          <div class="col-sm-6">
            <i class="bi bi-question-circle text-danger me-2"></i>
            <span class="small">Ayuda en línea</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Línea divisoria -->
    <hr class="my-3 opacity-25" />

    <!-- Sección legal y copyright -->
    <div class="row align-items-center">
      <div class="col-lg-8 mb-2 mb-lg-0">
        <ul class="list-inline mb-0">
          <li class="list-inline-item me-3">
            <a href="#" class="text-white-50 text-decoration-none small">
              <i class="bi bi-file-text me-1"></i>Términos y Condiciones
            </a>
          </li>
          <li class="list-inline-item me-3">
            <a href="#" class="text-white-50 text-decoration-none small">
              <i class="bi bi-lock me-1"></i>Aviso de Privacidad
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="text-white-50 text-decoration-none small">
              <i class="bi bi-info-circle me-1"></i>FEMSA
            </a>
          </li>
        </ul>
      </div>
      <div class="col-lg-4 text-lg-end">
        <p class="small text-white-50 mb-0">
          &copy; 2025 PPE TRACER. Todos los derechos reservados
        </p>
      </div>
    </div>
  </div>
</footer>

</html>