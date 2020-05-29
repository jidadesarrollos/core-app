(() => {
    'use strict';

    const form = document.querySelector('.payment-form');
    const dropinContainer = document.querySelector('.dropin-container');

    const dropinCallSuccess = (token) => {

        let params = {
            authorization: token,
            selector: dropinContainer,
            locale: 'es_ES',
            paypal: {
                flow: 'vault'
            }
        };

        const callback = (err, dropinInstance) => {
            if (err) {
                console.error(err);
                return;
            }

            form.addEventListener('submit', (event) => {
                event.preventDefault();
                dropinInstance.requestPaymentMethod((err, payload) => {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }
                    document.querySelector('[name="nonce"]').value = payload.nonce;
                    console.log('nonce', payload.nonce);
                    form.submit();
                });
            });

        };

        braintree.dropin.create(params, callback);

    };

    //se obtiene el token de braintree
    if (dropinContainer) {
        $.ajax({
            url: `${jida.urls.base}/braintree/token`,
            type: 'get',
            dataType: 'json',
            success: dropinCallSuccess
        });
    }

})();