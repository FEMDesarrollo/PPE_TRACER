<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PPE TRACER</title>

    <!-- Favicons -->
    {{-- <link href="assets/img/favicon.png" rel="icon"> --}}
    <link href="{{ asset('img/logotipo.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Monserrat', sans-serif
        }
        .active {
            position: relative;
        }
        .active::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background-color: red;
            position: absolute;
            bottom: -2px;
            left: 0;
        }
    </style>
</head>

<body>
    {{-- Navbar login responsive --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow p-3 mb-5 bg-body rounded">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold ps-4" href="/" style="color: #222944">PPE TRACER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="/" style="color: #222944">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" style="color: #222944" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sobre el sistema
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="color: #222944">
                            <li><a class="dropdown-item fw-bold" href="/#seccion-seguimiento">Información</a></li>
                            <li><a class="dropdown-item fw-bold" href="/#final-pagina">Soporte</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Card Login y responsive --}}
    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="card p-4 shadow-lg p-3 mb-5 bg-body rounded-3"
            style="width: 100%; max-width: 400px; border-color: #dee2e6;">
            <div class="text-center">
                {{-- Logo en card login, ajustar si es necesario --}}
                <img src="{{ asset('img/logotipo.png') }}" alt="Logo" class="mb-3"
                    style="width: 100px; height: 100px;">
                <h3 class="full-width-text p-2 py-3" style="color: #222944">Bienvenidos a <br> <strong>PPE TRACER</strong>
                </h3>
            </div>
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @php
                if(session('debug_data')) {
                    dump(session('debug_data'));
                }
            @endphp
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="correo" class="form-labelc fw-bold py-2" style="color: #222944">Correo
                        electrónico</label>
                    <input type="email" class="form-control"  style="border: 1px solid #b6bac6ff;" name="correo" id="correo" placeholder="usuario@example.com" value="{{old('correo')}}" class="@error('correo') is-invalid @enderror">
                    @error('correo')
                    <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold" style= "color: #222944">Contraseña</label>
                    <input type="password" class="form-control" style="border: 1px solid #b6bac6ff;" name="password" id="password" value="{{old('password')}}" class="@error('password') is-invalid @enderror">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn fw-bold submit-prevent-button"
                        style="background-color: #cf0a2c; color: white; border-color:#cf0a2c">Ingresar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
