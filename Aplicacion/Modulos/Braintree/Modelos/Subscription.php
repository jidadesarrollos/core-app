<?php

namespace App\Modulos\Braintree\Modelos;

use App\Modulos\Braintree\Modelos\Customer;
use Jida\Medios\Debug;

class Subscription extends Braintree {

    public $id_subscription;
    public $customer_id;
    public $payment_method_token;
    public $plan_id;
    public $price;
    public $bt_subscription_id;
    public $subscription_status;

    protected $tablaBD = "bt_subscriptions";
    protected $pk = "id_subscription";

    public function __construct() {
        parent::__construct();
    }

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
            'planId'             => isset($params['plan_id']) ? $params['plan_id'] : "",
            'price'              => isset($params['price']) ? $params['price'] : "",
        ];

        if (isset($this->bt_subscription_id) and !empty($this->bt_subscription_id)) {
            $this->gateway->subscription()->update($this->bt_subscription_id, $data);
        }
        else {
            $result = $this->gateway->subscription()->create($data);
            if ($result->success) {
                $this->bt_subscription_id = $result->subscription->id;
                $_customer = new Customer();
                $customer = $_customer->get($params['id_usuario'], true);
                $this->customer_id = $customer[0]['id_customer'];
                $this->subscription_status = $result->subscription->status;
            }
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

    public function changeStatus($params){
        $result = $this->consulta()->filtro(['bt_subscription_id' => $params['id']])->obt();
        $_subscription = $result[0];
        $_subscription['subscription_status'] = $params['status'];
        return $this->salvar($_subscription);
    }

}