($ => {
    'use strict';

    let $menu = $('#sidebar-menu');

    function procesarUrl(url) {
        $.get(url, function (data) {
            $('.content-page').html(
                `
               <div class="content">
                    <div class="container-fluid mt-4">
                        ${data}
                    </div>
               </div>
                `);
        });

        history.pushState({}, null, url);
    }

    let onLink = function (evento) {

        let target = evento.currentTarget;
        let link = target.href;
        evento.preventDefault();
        evento.stopPropagation();
        procesarUrl(link);

    };

    let $links = $menu.find('a');

    $links.each((nro, elemento) => {
        let link = elemento.href;
        let lastChar = link.charAt(link.length - 1);

        if (lastChar !== '#') {
            elemento.addEventListener('click', onLink);
        }

    });

})(jQuery);