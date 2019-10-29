const fs = global.fs;
const Path = require('path');

class Module {

    constructor(path) {
        this._path = path;
        this._read();
    }

    get name() {
        return 'module.json';
    }

    get path() {
        return this._path;
    }

    get config() {
        return this._config;
    }

    async _read() {

        const path = `${this._path}${Path.sep}${this.name}`;

        try {

            const file = await fs.readFile(path, {'encoding': 'utf8'});
            this._config = JSON.parse(file);

        }
        catch (e) {
            console.error(`the module.json is not valid ${path}`, e);
        }

    }

    async load() {
        const output = `${this._path}${Path.sep}code.js`;
        // todo: change logic, make types
        // todo: remove builder object
        const builder = new (require('../builder/module'));
        try {
            await builder.loadModule(this._config, this._path, output);
        }
        catch (e) {
            console.error('error', e);
        }

        console.log(`module compiled: ${output}`);
    }

}

module.exports = Module;
