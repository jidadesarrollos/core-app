<?php

namespace App\Modulos\Braintree\Modelos;

class Transaction extends Braintree {

    public $id_transaction;
    public $amount;
    public $id_payment_method;
    public $bt_transaction_id;
    public $id_customer;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_transactions";
    protected $pk = "id_transaction";

    public function __construct() {
        parent::__construct();
    }

    public function sale($params) {
        return $this->gateway->transaction()->sale($params);
    }

}