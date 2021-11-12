$('.delete').confirm({
    title: 'Confirmar!',
    content: 'Eliminar este registro?',
    theme: 'modern',
    buttons: {
        confirmar: {
        btnClass: 'btn-danger',
            action: function () {
                    $('.delete').addClass('is-loading').addClass('disabled');
                    document.getElementById('delete').submit();
                }
        },
        cancel: {
            btnClass: 'btn-outline-secondary',
                action: function () {

            }
        }
    }
});

$('.approved').confirm({
    title: 'Confirmar!',
    content: 'Aprovar este registro?',
    theme: 'modern',
    buttons: {
        confirmar: {
        btnClass: 'btn-danger',
            action: function () {
                    $('.approved').addClass('is-loading').addClass('disabled');
                    document.getElementById('approved').submit();
                }
        },
        cancel: {
            btnClass: 'btn-outline-secondary',
                action: function () {

            }
        }
    }
});

$('.rejected').confirm({
    title: 'Confirmar!',
    content: 'Rechazar este registro?',
    theme: 'modern',
    buttons: {
        confirmar: {
        btnClass: 'btn-danger',
            action: function () {
                    $('.rejected').addClass('is-loading').addClass('disabled');
                    document.getElementById('rejected').submit();
                }
        },
        cancel: {
            btnClass: 'btn-outline-secondary',
                action: function () {

            }
        }
    }
});