(() => {
    'use strict';

    const app = document.getElementById('app');

    ReactDOM.render(React.createElement(App, {
        'users': JSON.parse(app.dataset.usuarios)
    }), app);
})();