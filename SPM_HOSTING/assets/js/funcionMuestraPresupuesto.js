$(document).ready(function () {
    $('#contenedorPresupuesto').children('div').hide();
    $('#select2').on('change', function () {

        var valorSeleccionado = '#' + $(this).val();
        $('#contenedorPresupuesto').children('div').hide();
        $('#contenedorPresupuesto').children(valorSeleccionado).show();
    });
});