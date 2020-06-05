#WEBHOOKS
## Casos de uso

### 1 Test
Se obtiene una notificacion de tipo "Check", esta notificacion 
es disparada a traves de la interfaz de sandbox

````
$webhookNotification->kind = "check";
````

### 2 Transaccion liquidada o liquidacion rechazada 
Al realizar una transaccion, queda con estatus enviada al lote de liquidacion, en un tiempo
determinado Braintree realiza la liquidacion de las transacciones del lote, colocandole un estatus
liquidado ("settled") si todo esta OK o colocandole liquidacion rechazada ("settlement_declined"), 
esto ocurre si el banco del cliente devuelve el reembolso despues de que parece haberse liquidado.

````
//liquidada
$webhookNotification->kind = "transaction_settled";

//liquidacion rechazada
$webhookNotification->kind = "transaction_settlement_declined";
```` 

Adicional al atributo "kind", se tiene el "timestamp" para saber el momento que se disparo el webhook.
Tambien se tiene un atributo "transaction", que tiene la informacion de la transacion cuyo estatus cambio.

````
$webhookNotification->transaction->id; "id de la transaction"
```` 

### 3 Suscripcion cancelada

Se dispara cuando una suscripcion es cancelada, puede ocurrir si la
suscripcion es cancelada manualmente a traves de la interfaz de sandbox o mediante 
el objeto Suscription

````
$webhookNotification->kind = "subscription_canceled";
```` 