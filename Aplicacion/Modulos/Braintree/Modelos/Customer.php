<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Customer extends DataModel {

    public $id_customer;
    public $first_name;
    public $last_name;
    public $company;
    public $email;
    public $phone;
    public $fax;
    public $website;
    public $bt_customer_id;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_customers";
    protected $pk = "id_customer";

    public static function getAll() {

        $model = new Customer();
        $model->consulta(['id_customer', 'first_name', 'last_name', 'company', 'email', 'phone', 'fax', 'website', 'bt_customer_id']);
        $result = $model->obt();

        return $result;

    }

    public static function subscriptions($idCustomer) {

        $model = new Subscription();
        $model->consulta(['id_subscription', 'customer_id', 'payment_method_token', 'plan_id', 'price', 'bt_subscription_id']);
        $model->filtro(['customer_id' => $idCustomer]);
        $subscriptions = $model->obt();

        return $subscriptions;

    }

    public static function save($params, $id = "") {

        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
        $customer = new Customer($id);

        $data = [
            'firstName' => isset($params['first_name']) ? $params['first_name'] : "",
            'lastName'  => isset($params['last_name']) ? $params['last_name'] : "",
            'company'   => isset($params['company']) ? $params['company'] : "",
            'email'     => isset($params['email']) ? $params['email'] : "",
            'phone'     => isset($params['phone']) ? $params['phone'] : "",
            'fax'       => isset($params['fax']) ? $params['fax'] : "",
            'website'   => isset($params['website']) ? $params['website'] : "",
        ];

        if (isset($customer->bt_customer_id) and !empty($customer->bt_customer_id)) {
            $gateway->customer()->update($customer->bt_customer_id, $data);
        }
        else {
            $result = $gateway->customer()->create($data);
            if ($result->success) $customer->bt_customer_id = $result->customer->id;
        }

        $customer = $customer->salvar($params);

        return $customer;

    }

    public static function delete($id) {

        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
        $customer = new Customer($id);
        $result = false;

        if (isset($customer->id_customer)) {
            if (isset($customer->bt_customer_id) and !empty($customer->bt_customer_id)) {
                $gateway->customer()->delete($customer->bt_customer_id);
            }

            $result = $customer->eliminar();
        }

        return $result;

    }

}