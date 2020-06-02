<?php

namespace App\Modulos\Braintree\Modelos;

use Jida\BD\DataModel;

class Transaction extends DataModel {

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

}