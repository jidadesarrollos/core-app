<?php

namespace App\Modulos\Braintree\Controllers;

use App\Modulos\Braintree\Modelos\PaymentMethod;
use Jida\Manager\Estructura;
use JidaRender\JVista;

class PaymentMethods extends Braintree {

    public function __construct() {
        parent::__construct();
    }

    public function index($idCustomer = "") {

        if (empty($idCustomer)) {
            $this->redireccionar("/braintree/customers");
        }

        $modelo = new PaymentMethod();
        $data = $modelo->consulta(['id_payment_method', 'payment_method_nonce', 'id_customer'])
            ->filtro(['id_customer' => $idCustomer])
            ->obt();
        $parametros = ['titulos' => ['Método de pago', 'ID Cliente']];

        $vista = new JVista($data, $parametros);

        $vista->accionesFila([
            [
                'span'  => 'fas fa-edit',
                'title' => 'Editar',
                'href'  => '/braintree/payment-methods/update/{clave}'
            ],
            [
                'span'        => 'fas fa-trash',
                'title'       => 'Eliminar',
                'href'        => '/braintree/payment-methods/delete/{clave}',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Agregar' => ['href' => '/braintree/payment-methods/create/' . $idCustomer]]);

        $vista->addMensajeNoRegistros('No se encontraron registros.', [
            'link'    => '/braintree/payment-methods/create/' . $idCustomer,
            'txtLink' => 'Agregar'
        ]);

        $this->data(['vista' => $vista->render()]);

    }

    public function create($idCustomer = "") {

        if (empty($idCustomer)) {
            $this->redireccionar("/braintree/customers");
        }

        $this->layout()->incluirJS([
            "braintree" => "https://js.braintreegateway.com/web/dropin/1.20.2/js/dropin.min.js",
            "script"    => Estructura::$urlBase . "/Aplicacion/Modulos/Braintree/htdocs/js/script.js"
        ]);

        if ($this->post('nonce')) {

            $result = $this->gateway->paymentMethod()->create([
                'customerId'         => $idCustomer,
                'paymentMethodNonce' => $this->post('nonce')
            ]);

            if ($result->success) {
                $modelo = new PaymentMethod();
                $modelo->salvar([
                    'payment_method_nonce' => $this->post('nonce'),
                    'id_customer'          => $idCustomer
                ]);

                $this->redireccionar("/braintree/payment-methods/" . $idCustomer);
            }

        }

        $this->data([
            'idCustomer' => $idCustomer
        ]);

    }

}