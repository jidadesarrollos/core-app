(async () => {
    'use strict';

    const path = require('path');
    const appPath = `..${path.sep}Aplicacion`;
    const basePath = `..${path.sep}`;

    const chokidar = require('chokidar');

    const reader = new (require('./core/reader'))();
    const builder = new (require('./core/builder/module'))();

    const fs = require('./core/helpers').fs;

    const Modules = require('./core/modules');
    const modules = new Modules(appPath, basePath);

    // if (modules.entries.length) {
    //     modules.load();
    // }
    //const moduleJson = await fs.readFile(file, {'encoding': 'utf8'});

    // const outputPath = '../htdocs/dist/js/jida.bundle.js';
    // const module = reader.getJson(moduleJson);
    // const load = async () => builder.loadModule(module, path.resolve(file), outputPath);
    //
    // await load();
    //
    const watcher = chokidar.watch(
        appPath,
        {
            'ignored': /^[^\.].*$/,
            persistent: true
        }
    );
    console.log('listen jida files...');
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