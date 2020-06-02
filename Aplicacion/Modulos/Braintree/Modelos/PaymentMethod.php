<?php

namespace App\Modulos\Braintree\Modelos;

use Jida\BD\DataModel;

class PaymentMethod extends DataModel {

    public $id_payment_method;
    public $customer_id;
    public $payment_method_nonce;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_payment_methods";
    protected $pk = "id_payment_method";

}