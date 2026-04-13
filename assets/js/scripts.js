$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'click hover focus' 
        });
    });

    $(document).on('click touchstart', function (e) {
        if (!$(e.target).closest('[data-bs-toggle="tooltip"]').length) {
            $('[data-bs-toggle="tooltip"]').each(function () {
                var instance = bootstrap.Tooltip.getInstance(this);
                if (instance) {
                    instance.hide();
                }
            });
        }
    });
    $(document).on('click', '.btn-info-producto', function() {
            // Obtenemos los datos directamente de los atributos para asegurar frescura
        const btn = $(this);
        const cantidad = btn.attr('data-cantidad'); // Importante: leer del atributo actualizado
            const conservado = btn.data('conservado');
            const nombre = btn.data('nombre');
            const reserva = btn.data('reserva');
            const medida = btn.data('medida');
            const tipo = btn.data('tipo');
            const marca = btn.data('marca');

            const mensaje = `Hay ${cantidad} ${conservado}, sirve para ${nombre} en ${reserva} ${medida} de ${tipo} de la marca ${marca}`;

            alert(mensaje);
    });
});