<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Subscription extends DataModel {

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

    public static function getAll() {

        $model = new Subscription();
        $model->consulta(['id_subscription', 'customer_id', 'payment_method_token', 'plan_id', 'price', 'bt_subscription_id']);
        $subscriptions = $model->obt();

        return $subscriptions;

    }

    public static function get($id) {

        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
        return $gateway->subscription()->find($id);

    }

    public static function save($params, $id = "") {

        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
        $subscription = new Subscription($id);

        $data = [
            'paymentMethodToken' => isset($params['payment_method_token']) ? $params['payment_method_token'] : "",
            'planId'             => isset($params['plan']) ? $params['plan'] : "",
            'price'              => isset($params['price']) ? $params['price'] : "",
        ];

        if (isset($subscription->bt_subscription_id) and !empty($subscription->bt_subscription_id)) {
            $gateway->subscription()->update($subscription->bt_subscription_id, $data);
        }
        else {
            $result = $gateway->subscription()->create($data);
            if ($result->success) $subscription->bt_subscription_id = $result->subscription->id;
        }

        $subscription = $subscription->salvar($params);

        return $subscription;

    }

    public static function delete($id) {

        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
        $subscription = new Subscription($id);
        $result = false;

        if (isset($subscription->id_subscription)) {
            if (isset($subscription->bt_subscription_id) and !empty($subscription->bt_subscription_id)) {
                $gateway->subscription()->cancel($subscription->bt_subscription_id);
            }

            $result = $subscription->eliminar();
        }

        return $result;

    }

}