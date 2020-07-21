<?php

namespace App\Modulos\Braintree\Modelos;

use App\Modulos\Braintree\Modelos\Customer;
use Jida\Medios\Debug;

class Transaction extends Braintree {

    public $id_transaction;
    public $customer_id;
    public $amount;
    public $id_payment_method;
    public $bt_transaction_id;
    public $transaction_status;

    protected $tablaBD = "bt_transactions";
    protected $pk = "id_transaction";

    public function __construct() {
        parent::__construct();
    }

    public function create($params){

        $data = [
            'paymentMethodNonce' => isset($params['payment_method_nonce']) ? $params['payment_method_nonce'] : "",
            'amount'             => isset($params['amount']) ? $params['amount'] : "",
            'options'            => ['submitForSettlement' => True]
        ];

        $result = $this->gateway->transaction()->sale($data);

        if ($result->success) {
            $this->bt_transaction_id = $result->transaction->id;
            $this->transaction_status = $result->transaction->status;
            $_customer = new Customer();
            $customer = $_customer->get($params['id_usuario'], true);
            $this->customer_id = $customer[0]['id_customer'];
            $this->salvar($params);
            return $result->transaction;
        } else {
            Debug::imprimir(['error', $result], true);
        }
    }

    public function delete($id) {

        $this->instanciar($id);
        $result = false;

        if (isset($this->id_transaction)) {
            if (isset($this->bt_transaction_id) and !empty($this->bt_transaction_id)) {
                $this->gateway->transaction()->void($this->bt_transaction_id);
            }
            $result = $this->eliminar();
        }

        return $result;

    }

    public function changeStatus($params){
        $result = $this->consulta()->filtro(['bt_transaction_id' => $params['id']])->obt();
        $_transaction = $result[0];
        $_transaction['transaction_status'] = $params['status'];
        return $this->salvar($_transaction);
    }

}