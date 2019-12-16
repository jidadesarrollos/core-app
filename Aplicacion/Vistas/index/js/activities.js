function Activities() {
    'use strict';

    Object.defineProperty(this, 'ready', {'get': () => !!actividades});

    let actividades;
    Object.defineProperty(this, 'actividades', {'get': () => actividades});

    let binder;
    this.registerBinder = (callback) => binder = callback;

    const setState = () => {
        binder({
            'ready': this.ready,
            'actividades': actividades
        });
    };

    const loadActivities = async () => {

        try {

            let url = '/jadmin/actividades/obtbandeja';
            let data = {'getdata': true};

            const response = await fetch(url, {
                method: 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });

            data = await response.json();
            if (data.status === 'ok') actividades = data.data;
            setState();

        }
        catch (e) {
            console.error(e);
        }

    };

    loadActivities();

}