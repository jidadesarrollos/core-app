#Modulo de Braintree Gateway

1. Los API Keys para conectarse con Braintree se deben definir en el archivo de configuración ubicado en `Aplicacion/Config/Configuracion.php`.

```
const BRAINTREE_CONFIG = [
    'environment' => 'sandbox',
    'merchantId'  => 'jjyy8qvqf2dysdqb',
    'publicKey'   => '3ftnz9cvfc83sc9p',
    'privateKey'  => 'a400c02f66d6fb8dc8cb07d503bda1cd'
];
```

2. Una vez se han definido los parámetros de configuración, se debe instanciar el modelo `Gateway`.

```
$gateway = new Gateway();
```

3. Obtener el token para autenticar la aplicación para comunicarse directamente con Braintree.

```
$token = $gateway->token();
```

##Operaciones de Cliente

1. Crear un cliente.

```
$parametros = [
    'firstName'          => 'Pedro',
    'lastName'           => 'Perez',
    'email'              => 'pedro@mail.com',
    'phone'              => '555666777',
    'paymentMethodNonce' => $nonce,
    'creditCard'         => [
        'token'   => $paymentMethodToken,
        'options' => [
            'verifyCard' => true
        ]
    ]
];
$cliente = $gateway->cliente()->crear($parametros);
```

##Operaciones con Suscripciones

1. Crear suscripcion

```
$parametros = [
    'paymentMethodToken' => $paymentMethodToken,
    'planId'             => $plan,
    'price'              => $price
]
$suscripcion = $gateway->suscripcion()->crear($parametros);
```

2. Buscar suscripcion

```
$suscripcion = $gateway->suscripcion()->buscar($idSuscripcion);
```

3. Editar suscripcion

```
$parametros = [
    'price'              => $price
]
$suscripcion = $gateway->suscripcion()->editar($idSuscripcion, $parametros);
```

4. Cancelar suscripcion

```
$suscripcion = $gateway->suscripcion()->cancelar($idSuscripcion);
```

