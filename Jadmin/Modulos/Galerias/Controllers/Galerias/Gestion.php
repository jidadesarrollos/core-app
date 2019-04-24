<?php

namespace Jadmin\Modulos\Galerias\Controllers\Galerias;

use Jadmin\Modulos\Galerias\Modelos\Medias;
use Jida\Medios\Debug;
use Jida\Medios\Sesion;
use JidaRender\Formulario;

Trait Gestion {

    function _gestion($idBanner) {

        $form = new Formulario('jadmin/galerias/Media', $idBanner);
        $form->action = $this->obtUrl('', ['id' => $idBanner]);

        $form->boton('principal')->attr('type', 'button');

        if ($this->solicitudAjax() and $this->post('btnMedia')) {
            $this->gestionForm($form, $idBanner);
        }

        if (empty($idBanner)) {
            $this->redireccionar('/jadmin/galerias/');
        }

        $this->data([
            'id'   => $idBanner,
            'form' => $form->render()
        ]);

    }

    private function gestionForm(Formulario $form, $idBanner) {

        if (!$form->validar()) {
            //la clase formulario genera la variable de sesion __msjForm automaticamente
            //debe limpiarse para que no aparezca.
            Sesion::destruir('__msjForm');
            $this->respuestaJson(['estatus' => false]);
        }
        $banner = new Medias($idBanner);

        if (!$banner->salvar($this->post())) {
            $this->respuestaJson(['estatus' => false]);
        }

        $this->respuestaJson(['estatus' => true]);

    }

}