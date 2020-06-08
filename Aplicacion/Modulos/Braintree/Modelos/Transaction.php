<?php

namespace App\Modulos\Braintree\Modelos;

use Jida\Medios\Debug;

class Transaction extends Braintree {

    public $id_transaction;
    public $customer_id;
    public $amount;
    public $id_payment_method;
    public $bt_transaction_id;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

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
            $this->salvar($params);
            return $result->transaction;
        } else {
            Debug::imprimir(['error', $result], $result);
        }
    }

}