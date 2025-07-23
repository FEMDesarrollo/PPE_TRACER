@if ($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const oldId = @json(old('id'));
            const modalTipo = @json(old('modal'));

            if (modalTipo === 'añadir') {
                const modalAdd = document.getElementById('modalAñadir');
                if (modalAdd) {
                    const modal = new bootstrap.Modal(modalAdd);
                    modal.show();
                }
            } else if (oldId) {
                const modalEdit = document.getElementById('modalEditar' + oldId);
                if (modalEdit) {
                    const modal = new bootstrap.Modal(modalEdit);
                    modal.show();
                }
            }
        });
    </script>
@endif
