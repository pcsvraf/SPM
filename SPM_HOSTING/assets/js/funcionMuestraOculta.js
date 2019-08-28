$(document).ready(function () {
    $('#contenedorDivs').children('div').hide();
    $('#select').on('change', function () {

        var valorSeleccionado = '#' + $(this).val();
        $('#contenedorDivs').children('div').hide();
        $('#contenedorDivs').children(valorSeleccionado).show();
    });
});