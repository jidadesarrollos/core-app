const fs = global.fs;
const Module = require('./module');
const Path = require('path');

class Modules {

    constructor(app, base) {
        this._base = base;
        this._app = app;
        this._entries = new Map();
        this._directories = new Map();
        this.find(app);
    }

    get directories() {
        return this._directories;
    }

    get entries() {
        return this._entries;
    }

    find(dir) {

        const entries = fs.readdirSync(dir);

        entries.forEach(file => {

            const directory = `${dir}${Path.sep}${file}`;
            const isDirectory = fs.statSync(directory).isDirectory();

            if (!isDirectory && file !== 'module.json') return;
            if (isDirectory) return this.find(directory);

            const module = new Module(Path.resolve(dir), file);
            const intoFolder = fs.readdirSync(dir);

            intoFolder.forEach(index => {

                const directory = `${dir}${Path.sep}${index}`;
                const isDirectory = fs.statSync(directory).isDirectory();

                if (isDirectory) {
                    this._directories.set(directory, dir);
                }

            });

            this._directories.set(dir, dir);
            this._entries.set(`${dir}`, module);

        });

    }

}

module.exports = Modules;