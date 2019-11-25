(() => {
    'use strict';
    const Manager = require('jida-frontend-compiler');

    const config = {
        'path': './Aplicacion',
        'env': 'dev',
        'dev': {
            'imports': {
                'path': 'htdocs/modules/libs/',
                'files': {
                    'react': 'react.development.js',
                    'reactDOM': 'react-dom.development.js'
                }
            }
        },
        'prod': {
            'compress': true,
            'imports': {
                'path': 'htdocs/modules/libs/',
                'files': {
                    'react': 'react.development.js',
                    'reactDOM': 'react-dom.development.js'
                }
            }
        }
    };
    const manager = new Manager(config);

})();