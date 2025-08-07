<!-- Redireeciones para error y mensajes de exito del offcanvas (Perfil_configuración) -->
@if ($errors->any() || session('success') || old('modal') === 'configuracion' || session('modal') === 'configuracion')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const modalTipo = @json(old('modal') ?? session('modal'));
    const activeTab = @json(old('activeTab') ?? session('activeTab'));

    if (modalTipo === 'configuracion') {
      const offcanvasEl = document.getElementById('configuracionOffcanvas');
      const bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
      bsOffcanvas.show();

      if (activeTab) {
        const tabTrigger = document.querySelector(`#configTabs button[data-bs-target="#${activeTab}"]`);
        if (tabTrigger) {
          const tab = new bootstrap.Tab(tabTrigger);
          tab.show();
        }
      }
    }
  });
</script>
@endif
