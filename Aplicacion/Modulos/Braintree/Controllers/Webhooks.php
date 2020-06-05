<?php

namespace App\Modulos\Braintree\Controllers;

use App\Config\Configuracion;
use App\Controllers\App;
use App\Modulos\Braintree\Modelos\Webhook;
use Jida\Medios\Debug;

class Webhooks extends App {

    function index() {

        $bt_signature = $this->post('bt_signature');
        $bt_payload = $this->post('bt_payload');

        if (
            isset($bt_signature) &&
            isset($bt_payload)
        ) {
            $gateway = new \Braintree\Gateway(Configuracion::BRAINTREE_CONFIG);

            $webhookNotification = $gateway->webhookNotification()->parse(
                $bt_signature, $bt_payload
            );

            switch ($webhookNotification->kind){
                case 'transaction_settled':
                case 'transaction_settlement_declined':
                    $model = 'Transaction';
                    break;
                case 'subscription_canceled':
                case 'subscription_expired':
                case 'subscription_went_active':
                case 'subscription_went_past_due':
                case 'subscription_charged_successfully':
                    $model = 'Subscription';
                    break;
                case 'payment_method_revoked_by_customer':
                    $model = 'PaymentMethod';
                    break;
                case 'check':
                    echo 'url checked';

            }

        }

    }

    function lista() {

    }

}

