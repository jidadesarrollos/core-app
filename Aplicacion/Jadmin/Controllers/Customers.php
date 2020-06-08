<?php

namespace App\Jadmin\Controllers;

use App\Modulos\Braintree\Modelos\Customer;
use Jida\Medios\Mensajes;
use JidaRender\Formulario;
use JidaRender\JVista;

class Customers extends Jadmin {

    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Customer();
    }

    public function index() {

        $data = $this->model->getAll();
        $params = ['titulos' => ['Nombres', 'Apellidos', 'Empresa', 'Email', 'Telefono', 'Fax', 'Website', 'ID Braintree']];

        $vista = new JVista($data, $params);

        $vista->accionesFila([
            [
                'span'  => 'fas fa-eye',
                'title' => 'Suscripciones',
                'href'  => '/jadmin/subscriptions/index/{clave}'
            ],
            [
                'span'  => 'fas fa-edit',
                'title' => 'Editar',
                'href'  => '/jadmin/customers/gestion/{clave}'
            ],
            [
                'span'        => 'fas fa-trash',
                'title'       => 'Eliminar',
                'href'        => '/jadmin/customers/eliminar/{clave}',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Agregar cliente' => ['href' => '/jadmin/customers/gestion']]);

        $vista->addMensajeNoRegistros('No se encontraron registros.', [
            'link'    => '/jadmin/customers/gestion',
            'txtLink' => 'Agregar cliente'
        ]);

        $this->data(['vista' => $vista->render()]);

    }

    function gestion($id = "") {

        $form = new Formulario('Customers', $id);

        if ($this->post('btnCustomers')) {

            if ($form->validar()) {

                $this->model->save($this->post(), $id);
                $accion = (empty($id)) ? 'guardado' : 'modificado';
                $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                Mensajes::almacenar(Mensajes::suceso($msj));
                $this->redireccionar("/jadmin/customers");

            }
            else {
                $form::msj('error', 'Los datos ingresados no son validos');
            }

        }

        $this->data([
            "form" => $form->render()
        ]);

    }

    function eliminar($id = "") {

        $msj = $this->model->delete($id) ?
            Mensajes::suceso('El registro ha sido eliminado correctamente') :
            Mensajes::error('El registro que desea eliminar no existe');

        Mensajes::almacenar($msj);
        $this->redireccionar("/jadmin/customers");

    }

}