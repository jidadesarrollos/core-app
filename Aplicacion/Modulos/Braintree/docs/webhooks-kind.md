#WEBHOOKS
## Tipo de hooks

* Subscription status changes (https://developers.braintreepayments.com/reference/general/webhooks/subscription/php)
* Disbursements to your account (https://developers.braintreepayments.com/reference/general/webhooks/disbursement/php)
* Disputes on transactions (https://developers.braintreepayments.com/reference/general/webhooks/dispute/php)
* Account Updater activity (https://developers.braintreepayments.com/reference/general/webhooks/account-updater/php)
* Braintree Marketplace sub-merchant account status changes (https://developers.braintreepayments.com/reference/general/webhooks/sub-merchant-account/php)
* Grant API granted payment method status changes (https://developers.braintreepayments.com/reference/general/webhooks/grant-api/php)
* Local Payment Methods that are completed by a customer (https://developers.braintreepayments.com/reference/general/webhooks/local-payment-methods/php)
* Payment Method status changes (https://developers.braintreepayments.com/reference/general/webhooks/payment-method/php)
* OAuth access revocation (https://developers.braintreepayments.com/reference/general/webhooks/oauth/php)
* Tests that verify your endpoint (https://developers.braintreepayments.com/reference/general/webhooks/test/php)
* ACH Direct Debit transaction statuses (https://developers.braintreepayments.com/reference/general/webhooks/transaction/php)

## Configuracion de Webhooks

Todos los tipos son configurados al momento de crear o editar un Webhook, mediante
la interfaz provista por sandbox, en el panel de control se mostrará un listado
con cada uno de los eventos, donde se puede marcar o desmarcar los eventos segun
su conveniencia o necesidad. 

Para la creacion de webhooks hay que tener en cuenta que se necesita una URL HTTPS
(EJ: https://www.example.com/webhooks.php), donde va a llegar una una peticion de tipo POST con dos
valores: "bt_signature" y "bt_payload", los cuales deben ser parseados usando:

```
$webhookNotification = $gateway->webhookNotification()->parse(
    $_POST["bt_signature"], $_POST["bt_payload"]
);
```

Despues de parsear la respuesta, tenemos un objeto de tipo WebhookNotification, el cual tiene como atributos
un "kind", un "timestamp" y un atributo adicional que es específico del tipo de notificación.

Se recomienda guardar en Base de Datos la informacion de la notificacion.