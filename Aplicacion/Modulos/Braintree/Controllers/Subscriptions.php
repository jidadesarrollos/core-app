<?php

namespace App\Modulos\Braintree\Controllers;

use App\Modulos\Braintree\Modelos\Subscription;
use JidaRender\JVista;

class Subscriptions extends Braintree {

    public function __construct() {
        parent::__construct();
    }

    public function index($idCustomer = "") {

        if (empty($idCustomer)) {
            $this->redireccionar("/braintree/customers");
        }

        $modelo = new Subscription();
        $data = $modelo->consulta(['id_subscription', 'payment_method_token', 'plan_id', 'bt_subscription_id'])
            ->filtro(['id_customer' => $idCustomer])
            ->obt();
        $parametros = ['titulos' => ['Método de pago', 'ID Plan', 'ID Suscripción']];

        $vista = new JVista($data, $parametros);

        $vista->accionesFila([
            [
                'span'  => 'fas fa-edit',
                'title' => 'Editar',
                'href'  => '/braintree/subscriptions/update/{clave}'
            ],
            [
                'span'        => 'fas fa-trash',
                'title'       => 'Eliminar',
                'href'        => '/braintree/subscriptions/delete/{clave}',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Agregar' => ['href' => '/braintree/subscriptions/create/' . $idCustomer]]);

        $vista->addMensajeNoRegistros('No se encontraron registros.', [
            'link'    => '/braintree/subscriptions/create/' . $idCustomer,
            'txtLink' => 'Agregar'
        ]);

        $this->data(['vista' => $vista->render()]);

    }

    public function create($idCustomer = "") {

        if (empty($idCustomer)) {
            $this->redireccionar("/braintree/customers");
        }

        if ($this->post('nonce')) {

            $result = $this->gateway->subscription()->create([
                'paymentMethodToken' => $this->post('payment_method_token'),
                'planId'             => $this->post('plan_id')
            ]);

            if ($result->success) {
                $modelo = new Subscription();
                $modelo->salvar([
                    'payment_method_token' => $this->post('payment_method_token'),
                    'id_customer'          => $idCustomer
                ]);

                $this->redireccionar("/braintree/subscriptions/" . $idCustomer);
            }

        }

        $this->data([
            'idCustomer' => $idCustomer
        ]);

    }

}