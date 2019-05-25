(function ($) {
    'use strict';

    let page = $('#gestion-media-page').get(0);
    let $form = $(page.querySelector('form'));

    let btnCierre = page.querySelector('.btn-cierre');

    let $videoOption = $(page.querySelector('#tipo_media'));
    let $videoUrl = $(page.querySelector('#video_url'));

    btnCierre.addEventListener('click', () => bootbox.hideAll());

    $videoOption.change(function(){
        if($(this).val()==='2'){
            console.log($videoUrl);
            $videoUrl.attr('type','text');
            $videoUrl.before('<label for="video_url">ID del Video</label>');
        }
    });


    function imprimirMensaje(tipo, mensaje) {

        let alert = page.querySelector('.alert');
        if (alert) {
            alert.innerHTML = '';
            alert.insertAdjacentHTML('afterbegin', mensaje);
            return;
        }

        let titulo = page.querySelector('.titulo');
        let plantilla = Mustache.render(tplMensaje, {
            'mensaje': mensaje,
            'css': CSS_MENSAJES[tipo]
        });

        titulo.insertAdjacentHTML('afterend', plantilla);

    }

    $('#btnFormularioMedia').on('click', ()=> {

        console.log('Enviando');
        let form = page.querySelector('form');
        let formData = new FormData(form);

        let request = new XMLHttpRequest();
        request.open("POST", form.action);
        request.onreadystatechange = function (aEvt) {
            if (request.readyState == 4) {
                if(request.status == 200)
                    bootbox.hideAll()
            }
        };
        request.send(formData);

    });

    function enviarForm(evento, form, boton) {



        let $target = $(boton);
        formData.append('btnMedia', true);
        $target.attr({
            'value': 'Guardando...',
            'disabled': true
        });

        $.ajax({
            'url': form.action,
            'data': formAObjeto(formData),
            'type': 'post',
            'dataType': 'json'

        }).done(respuesta => {

            $target.attr({
                'value': 'Guardar',
                'disabled': false
            });

            if (!respuesta.estatus) {
                imprimirMensaje('error', 'No se ha podido guardar, intente nuevamente.');
                return;
            }

            imprimirMensaje('success', 'Datos guardados');

        });

    }

    $form.on('jida:form.validado', enviarForm);

})(jQuery);