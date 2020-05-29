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

    public function __construct() {
        parent::__construct();
    }

    public function create($params) {
        return $this->gateway->customer()->create($params);
    }

    public function find($id) {
        return $this->gateway->customer()->find($id);
    }

    public function update($id, $params) {
        return $this->gateway->customer()->update($id, $params);
    }

    public function delete($id) {
        return $this->gateway->customer()->delete($id);
    }

}