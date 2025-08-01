{{-- resources/views/errors/permiso-denegado.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>403 | Acceso Denegado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .error-card {
            animation: fadeIn 0.8s ease-in-out;
            max-width: 500px;
        }
        .error-icon {
            font-size: 4rem;
            color: #dc3545;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-custom {
            background-color: #0d6efd;
            color: #fff;
            transition: 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #084298;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="bg-white p-5 rounded shadow error-card text-center">
        <div class="mb-3">
            <i class="fas fa-ban error-icon"></i>
        </div>
        <h1 class="display-4 text-danger">403</h1>
        <h2 class="fw-bold">Acceso Denegado</h2>
        <p class="text-muted">No tienes los permisos necesarios para acceder a esta sección del sistema.</p>
        <a href="{{ url()->previous() }}" class="btn btn-custom mt-4">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>
</body>
</html>
