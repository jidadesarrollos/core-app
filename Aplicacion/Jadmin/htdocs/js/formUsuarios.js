(function ($) {
    'use strict';

    let $tipoUsuario = $('#tipo_usuario');
    let $idCargo = $('#id_cargo');
    let $idDepto = $('#id_departamento');

    function toggle(opt) {

        if (opt === '1') {
            $idCargo.css('display', 'block');
            $idCargo.prev('label').css('display', 'block');
            $idDepto.css('display', 'block');
            $idDepto.prev('label').css('display', 'block');
            return;
        }

        $idCargo.val('');
        $idCargo.css('display', 'none');
        $idCargo.prev('label').css('display', 'none');
        $idDepto.val('');
        $idDepto.css('display', 'none');
        $idDepto.prev('label').css('display', 'none');

    }

    $().ready(function () {
        toggle($tipoUsuario.val());
    });

    $tipoUsuario.change(function () {
        toggle($(this).val());
    });

})(jQuery);
