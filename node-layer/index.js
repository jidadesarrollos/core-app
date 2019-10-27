(async () => {
    'use strict';

    const fs = require('fs');
    const reader = new (require('./reader'))();
    const webpack = require('webpack');
    const {promisify} = require('util');
    fs.readFile = promisify(fs.readFile);
    fs.writeFile = promisify(fs.writeFile);
    //reader.read(require('path').resolve(__dirname, '..'));

    const file = '../htdocs/modules/jsx/first.jsx';
    const source = await fs.readFile(file, {'encoding': 'utf8'});
    const compiled = require('@babel/core').transform(source, {
        plugins: ['@babel/plugin-transform-react-jsx']
    });

    fs.writeFile('../htdocs/dist/js/jida.bundle.js', compiled.code);

})();