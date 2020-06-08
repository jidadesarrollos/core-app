<?php

namespace App\Modulos\Braintree\Modelos;

class Customer extends Braintree {

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

    private $_subscription;

    public function __construct() {
        parent::__construct();
        $this->_subscription = new Subscription();
    }

    public function getAll() {
        $this->consulta(['id_customer', 'first_name', 'last_name', 'company', 'email', 'phone', 'fax', 'website', 'bt_customer_id']);
        return $this->obt();
    }

    public function subscriptions($idCustomer) {
        $this->_subscription->consulta(['id_subscription', 'customer_id', 'payment_method_token', 'plan_id', 'price', 'bt_subscription_id']);
        $this->_subscription->filtro(['customer_id' => $idCustomer]);

        return $this->_subscription->obt();
    }

    public function save($params, $id = "") {

        $this->instanciar($id);
        $data = [
            'firstName' => isset($params['first_name']) ? $params['first_name'] : "",
            'lastName'  => isset($params['last_name']) ? $params['last_name'] : "",
            'company'   => isset($params['company']) ? $params['company'] : "",
            'email'     => isset($params['email']) ? $params['email'] : "",
            'phone'     => isset($params['phone']) ? $params['phone'] : "",
            'fax'       => isset($params['fax']) ? $params['fax'] : "",
            'website'   => isset($params['website']) ? $params['website'] : "",
        ];

        if (isset($this->bt_customer_id) and !empty($this->bt_customer_id)) {
            $this->gateway->customer()->update($this->bt_customer_id, $data);
        }
        else {
            $result = $this->gateway->customer()->create($data);
            if ($result->success) $this->bt_customer_id = $result->customer->id;
        }

        return $this->salvar($params);

    }

    public function delete($id) {

        $result = false;
        $this->instanciar($id);

        if (isset($this->id_customer)) {
            if (isset($this->bt_customer_id) and !empty($this->bt_customer_id)) {
                $this->gateway->customer()->delete($this->bt_customer_id);
            }

            $result = $this->eliminar();
        }

        return $result;

    }

}