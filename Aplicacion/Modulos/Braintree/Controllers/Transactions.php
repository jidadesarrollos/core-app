<?php

namespace App\Modulos\Braintree\Controllers;

use App\Controllers\App;
use App\Modulos\Braintree\Modelos as Models;
use Jida\Medios\Debug;
use Jida\Medios\Mensajes;
use JidaRender\Formulario;
use JidaRender\JVista;

class Transactions extends App {

    private $model;
    private $customer;

    public function __construct() {
        parent::__construct();
        $this->customer = new Models\Customer();
        $this->model = new Models\Transaction();
    }

    public function index($idCustomer = "") {

        $data = $this->customer->transactions($idCustomer);
        $parametros = ['titulos' => ['ID Cliente', 'Monto', 'Metodo de Pago', 'ID Transaccion', 'Estatus']];

        $vista = new JVista($data, $parametros);

        $vista->accionesFila([
            [
                'span'        => 'fas fa-trash',
                'title'       => 'Eliminar',
                'href'        => '/braintree/transactions/delete/' . $idCustomer . '/{clave}',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Agregar transaccion' => ['href' => '/transactions/create/' . $idCustomer]]);

        $vista->addMensajeNoRegistros('No se encontraron registros.', [
            'link'    => '/braintree/transactions/create/' . $idCustomer,
            'txtLink' => 'Agregar transaccion'
        ]);

        $this->data(['vista' => $vista->render()]);

    }

    function lista() {

    }

    function create(){
        $payment_method = new Models\PaymentMethod();
        $client_nonce = $payment_method->createNonce('966pkdb');
        $transaction = new Models\Transaction();
        $params = [
            'payment_method_nonce'=> $client_nonce,
            'amount'=> 10,
            'id_usuario' => 2
        ];
        $transaction->create($params);
    }

    function delete($idCustomer, $id = "") {

        $msj = $this->model->delete($id) ?
            Mensajes::suceso('El registro ha sido eliminado correctamente') :
            Mensajes::error('El registro que desea eliminar no existe');

        Mensajes::almacenar($msj);
        $this->redireccionar("/braintree/transactions/" . $idCustomer);

    }

}

