(function ($) {
    'use strict';

    $('.datepicker').datepicker({
        'format': 'yyyy-mm-dd'
    });

    $('.datepicker').on('changeDate', function (e) {
        $(this).attr('autocomplete', 'off');
        $(this).datepicker('hide');
    });

    let idc = $('#id_centro_costo').val();
    let ids = $('#id_subcentro_costo').val();

    $('#horas').on('load',function () {
        this.attr("step","0.01");
    });

    $('#id_centro_costo').on('change', function () {
        cargaSubcentro(this.value);
    });

    function cargaSubcentro(idc) {

        $.getJSON(`/jadmin/centros-costos/subcentro/${idc}`, '', function (data) {
            let option = `<option value="">Seleccione</option>`;
            for (let i = 0; i < data.length; i++) {
                option += `<option value="${data[i].id_subcentro_costo}">${data[i].subcentro_costo}</option>`;
            }
            $('#id_subcentro_costo').empty().append(option);
            $('#id_subcentro_costo').val(ids).change();
        });

    }

    cargaSubcentro(idc);

})(jQuery);
