<!--Alertas (mensajes en verde) para cuando se da de alta un nuevo registro, se edita o se elimina -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>

  <script>
    setTimeout(() => {
      const successAlert = document.getElementById('success-alert');
      if (successAlert) {
        successAlert.classList.remove('show');
        successAlert.classList.add('fade');

        setTimeout(() => {
          successAlert.remove();
        }, 500); 
      }
    }, 5000);
  </script>
@endif
