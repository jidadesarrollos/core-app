const Path = require('path');
const helpers = global.helpers;
const processors = ['jsx', 'js'];

class Builder {

    async loadModule(module, location, output) {

        let path = location.split('Aplicacion')[1].split(Path.sep);

        let jumps = '';
        for (let step in path) jumps += '../';
        // todo: validate bundle types.
        const bundleManager = new (require('./bundles/code'))(jumps);
        await bundleManager.process(module, location, output);

    }

}

module.exports = Builder;