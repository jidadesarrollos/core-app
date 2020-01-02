/**
 * Builder bundles for client files.
 *
 * @author Julio Rodriguez
 * @github: https://www.github.com/jr0driguez
 * @email: jrodriguez@jidadesarrollos.com
 *
 */
(async () => {
    'use strict';

    const helpers = require('./core/helpers');
    const path = require('path');
    const appPath = `..${path.sep}Aplicacion`;
    const basePath = `..${path.sep}`;

    const chokidar = require('chokidar');
    const Modules = require('./core/modules');
    const modules = new Modules(appPath, basePath);

    let config = helpers.getJSON('./config.json');
    if (typeof config[config.env] !== 'undefined') {
        config = Object.assign(config, config[config.env]);
    }

    Object.defineProperty(global, 'helpers', {'get': () => helpers});
    Object.defineProperty(global, 'CONFIG', {'get': () => config});
    console.log(1, appPath);
    const watcher = chokidar.watch(
        appPath,
        {
            'ignored': /^[^\.].*$/,
            'persistent': true
        }
    );

    console.log('listen files...');
    watcher.on('change', async (file, v) => {
        //await load();
        const dir = path.dirname(file);
        const isListened = modules.directories.has(dir);

        console.log('updating bundles...');
        if (isListened) {
            const pathModule = modules.directories.get(dir);
            const module = modules.entries.get(pathModule);
            module.load();
        }

    })

})();