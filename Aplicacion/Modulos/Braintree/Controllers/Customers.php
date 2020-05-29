<?php

namespace App\Modulos\Braintree\Controllers;

use App\Modulos\Braintree\Modelos\Customer;
use JidaRender\JVista;

class Customers extends Braintree {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $modelo = new Customer();
        $data = $modelo->consulta(['id_customer', 'first_name', 'last_name', 'email', 'phone'])->obt();
        $parametros = ['titulos' => ['Nombres', 'Apellidos', 'Email', 'Telefono']];

        $vista = new JVista($data, $parametros);

        $vista->accionesFila([
            [
                'span'  => 'fas fa-edit',
                'title' => 'Editar',
                'href'  => '/braintree/customers/update/{clave}'
            ],
            [
                'span'        => 'fas fa-trash',
                'title'       => 'Eliminar',
                'href'        => '/braintree/customers/delete/{clave}',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Agregar cliente' => ['href' => '/braintree/customers/create']]);

        $vista->addMensajeNoRegistros('No se encontraron registros.', [
            'link'    => '/braintree/customers/create',
            'txtLink' => 'Agregar cliente'
        ]);

        $this->data(['vista' => $vista->render()]);

    }

    public function create() {

        if ($this->post('btnSubmit')) {

            $result = $this->gateway->customer()->create([
                'firstName' => $this->post('first_name'),
                'lastName'  => $this->post('last_name'),
                'company'   => $this->post('company'),
                'email'     => $this->post('email'),
                'phone'     => $this->post('phone'),
                'fax'       => $this->post('fax'),
                'website'   => $this->post('website')
            ]);

            if ($result->success) {
                $this->post('bt_customer_id', $result->customer->id);
                $modelo = new Customer();
                if ($modelo->salvar($this->post())) {
                    $this->redireccionar('/braintree/customers');
                }
            }

        }

    }

    public function update($id) {

    }

    public function delete($id) {

    }

}