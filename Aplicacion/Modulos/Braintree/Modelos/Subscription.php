<?php

namespace App\Modulos\Braintree\Modelos;

class Subscription extends Braintree {

    public $id_subscription;
    public $customer_id;
    public $payment_method_token;
    public $plan_id;
    public $price;
    public $bt_subscription_id;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_subscriptions";
    protected $pk = "id_subscription";

    public function getAll() {
        $this->consulta(['id_subscription', 'customer_id', 'payment_method_token', 'plan_id', 'price', 'bt_subscription_id']);
        return $this->obt();
    }

    public function get($id) {
        return $this->gateway->subscription()->find($id);
    }

    public function save($params, $id = "") {

        $this->instanciar($id);

        $data = [
            'paymentMethodToken' => isset($params['payment_method_token']) ? $params['payment_method_token'] : "",
            'planId'             => isset($params['plan']) ? $params['plan'] : "",
            'price'              => isset($params['price']) ? $params['price'] : "",
        ];

        if (isset($this->bt_subscription_id) and !empty($this->bt_subscription_id)) {
            $this->gateway->subscription()->update($this->bt_subscription_id, $data);
        }
        else {
            $result = $this->gateway->subscription()->create($data);
            if ($result->success) $this->bt_subscription_id = $result->subscription->id;
        }

        return $this->salvar($params);

    }

    public function delete($id) {

        $this->instanciar($id);
        $result = false;

        if (isset($this->id_subscription)) {
            if (isset($this->bt_subscription_id) and !empty($this->bt_subscription_id)) {
                $this->gateway->subscription()->cancel($this->bt_subscription_id);
            }

            $result = $this->eliminar();
        }

        return $result;

    }

}