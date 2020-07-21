<?php

namespace App\Jadmin\Controllers;

use App\Modulos\Braintree\Modelos\Customer;
use App\Modulos\Braintree\Modelos\Subscription;
use Jida\Medios\Mensajes;
use JidaRender\Formulario;
use JidaRender\JVista;

class Subscriptions extends Jadmin {

    private $model;
    private $customer;

    public function __construct() {
        parent::__construct();
        $this->customer = new Customer();
        $this->model = new Subscription();
    }

    public function index($idCustomer = "") {

        $data = $this->customer->subscriptions($idCustomer);
        $parametros = ['titulos' => ['ID Cliente', 'Metodo de pago', 'Plan', 'Precio', 'ID Suscripcion', 'Estatus']];

        $vista = new JVista($data, $parametros);

        $vista->accionesFila([
            [
                'span'        => 'fas fa-trash',
                'title'       => 'Eliminar',
                'href'        => '/jadmin/subscriptions/eliminar/' . $idCustomer . '/{clave}',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Agregar suscripcion' => ['href' => '/jadmin/subscriptions/gestion/' . $idCustomer]]);

        $vista->addMensajeNoRegistros('No se encontraron registros.', [
            'link'    => '/jadmin/subscriptions/gestion/' . $idCustomer,
            'txtLink' => 'Agregar suscripcion'
        ]);

        $this->data(['vista' => $vista->render()]);

    }

    function gestion($idCustomer, $id = "") {

        $form = new Formulario('Subscriptions', $id);

        if ($this->post('btnSubscriptions')) {

            if ($form->validar()) {

                $this->model->save($this->post(), $id);
                $accion = (empty($id)) ? 'guardado' : 'modificado';
                $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                Mensajes::almacenar(Mensajes::suceso($msj));
                $this->redireccionar("/jadmin/subscriptions/" . $idCustomer);

            }
            else {
                $form::msj('error', 'Los datos ingresados no son validos');
            }

        }

        $this->data([
            "form" => $form->render()
        ]);

    }

    function eliminar($idCustomer, $id = "") {

        $msj = $this->model->delete($id) ?
            Mensajes::suceso('El registro ha sido eliminado correctamente') :
            Mensajes::error('El registro que desea eliminar no existe');

        Mensajes::almacenar($msj);
        $this->redireccionar("/jadmin/subscriptions/" . $idCustomer);

    }

}