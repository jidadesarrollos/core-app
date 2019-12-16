(() => {
    'use strict';

    const asignar = document.getElementById('jadmin-actividades-asignar-page');

    if (asignar) {

        let usuarios = asignar.dataset.usuarios;
        let prioridades = asignar.dataset.prioridades;

        ReactDOM.render(React.createElement(Control, {
            'usuarios': JSON.parse(usuarios),
            'prioridades': JSON.parse(prioridades)
        }), asignar);

    }

    const bandeja = document.getElementById('jadmin-actividades-bandeja-page');

    if (bandeja) {

        let statusActividades = bandeja.dataset.status;

        ReactDOM.render(React.createElement(Bandeja, {
            'statusActividades': JSON.parse(statusActividades)
        }), bandeja);

    }

})();