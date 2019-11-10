const Path = require('path');

class Builder {

    async loadModule(module, location, output) {

        let path = location.split('Aplicacion')[1].split(Path.sep);

        let jumps = '';
        for (let step in path) jumps += '../';
        // todo: validate bundle types.
        let bundle = 'code';

        if (module.bundle) {
            bundle = module.bundle;
            delete module.bundle;
        }

        const bundleManager = new (require('./bundles/dep'))(jumps);
        return;
        await bundleManager.process(module, location, output);

    }

}

module.exports = Builder;