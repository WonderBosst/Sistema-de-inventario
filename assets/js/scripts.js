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
});

