$(document).ready(function() {
    
    // --- 1. LÓGICA PARA TABLAS RESPONSIVAS ---
    // Recorremos cada tabla para asignar los data-label de los encabezados a las celdas
    $('table').each(function() {
        var $table = $(this);
        var headers = [];

        // Guardamos los nombres de las columnas del thead
        $table.find('thead th').each(function() {
            headers.push($(this).text().trim());
        });

        // Asignamos cada nombre de columna a su celda correspondiente en el tbody
        $table.find('tbody tr').each(function() {
            $(this).find('td').each(function(index) {
                $(this).attr('data-label', headers[index]);
            });
        });
    });

    // --- 2. CONFIGURACIÓN DE TOOLTIPS (Bootstrap) ---
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'click hover focus' 
        });
    });

    // Cerrar tooltips al hacer clic fuera de ellos
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

    // --- 3. EVENTO PARA BOTÓN DE INFORMACIÓN DE PRODUCTO ---
    $(document).on('click', '.btn-info-producto', function() {
        // Obtenemos los datos directamente de los atributos para asegurar frescura
        const btn = $(this);
        const cantidad = btn.attr('data-cantidad'); 
        const conservado = btn.data('conservado');
        const nombre = btn.data('nombre');
        const reserva = btn.data('reserva');
        const medida = btn.data('medida');
        const tipo = btn.data('tipo');
        const marca = btn.data('marca');
        const mensaje = `Hay ${cantidad} ${conservado} que contienen cada uno ${reserva} ${medida} de ${nombre} de tipo ${tipo} de la marca ${marca}`;

        alert(mensaje);
    });

    let miGrafica;

    function cargarGrafica() {
    const mes = $('#filter_mes').val();
    const anio = $('#filter_anio').val();
    const tipo = $('#filter_tipo').val();

    $.ajax({
        url: '../includes/obtener_estadisticas.php',
        type: 'POST',
        data: { mes: mes, anio: anio, tipo: tipo },
        dataType: 'json', // <--- AGREGA ESTA LÍNEA
        success: function(data) {
            console.log("Datos recibidos:", data);
            const ctx = document.getElementById('graficaEstadisticas').getContext('2d');
            
            if (miGrafica) { miGrafica.destroy(); }

            miGrafica = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total',
                        data: data.valores,
                        backgroundColor: 'rgba(38, 141, 181, 0.6)',
                        borderColor: 'rgb(38, 141, 181)',
                        borderWidth: 1
                    }]
                },
                options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Esta función obliga a que solo se muestren números enteros
                                    stepSize: 1, 
                                    callback: function(value) {
                                        if (value % 1 === 0) {
                                            return value;
                                        }
                                    }
                                }
                            }
                        }
                    }
            });
        },
        error: function(xhr) {
            console.error("Error en la carga:", xhr.responseText);
        }
    });
}

$('#filter_mes, #filter_anio, #filter_tipo').on('change', cargarGrafica);

cargarGrafica(); 

});