<?php

namespace App\Modulos\Braintree\Modelos;

class Subscription extends Braintree {

    public $id_subscription;
    public $payment_method_token;
    public $plan_id;
    public $bt_subscription_id;
    public $id_customer;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_subscriptions";
    protected $pk = "id_subscription";

    public function __construct() {
        parent::__construct();
    }

    public function create($params) {
        return $this->gateway->subscription()->create($params);
    }

    public function find($id) {
        return $this->gateway->subscription()->find($id);
    }

    public function update($id, $params) {
        return $this->gateway->subscription()->update($id, $params);
    }

    public function cancel($id) {
        return $this->gateway->subscription()->cancel($id);
    }

}