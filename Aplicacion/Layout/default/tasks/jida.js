function Jida(section) {
    'use strict';

    if (!section) section = 'default';

    const fs = require('fs');

    let version = '?v=0.1.6';
    let THEME_DIR, APP_DIR;

    let entries = [];
    Object.defineProperty(this, 'entries', {'get': () => entries});
    let theme;
    Object.defineProperty(this, 'theme', {'get': () => theme});

    this.read = () => {

        THEME_DIR = process.cwd();
        APP_DIR = '../../../';

        console.log('reading theme...');
        let rawdata = fs.readFileSync('tema.json');
        try {
            theme = JSON.parse(rawdata);
            if (!theme.hasOwnProperty('dev')) throw new Error('the dev enviroment is not propertly set');
        }
        catch (e) {
            throw new Error('the theme file is not valid');
        }

        return this;

    };

    this.prepare = lang => {

        if (!theme.dev.hasOwnProperty(lang)) {
            console.error(`the ${lang} lang is not config on jida theme`);
            return;
        }
        //Object.values(tema.dev.css.default)
        entries = validatePaths(Object.values(theme.dev[lang][section]));

    };

    const validatePaths = (entries) => {

        const fs = require('fs');

        for (let indice in entries) {
            let item = entries[indice];

            item = item.replace(version, '');

            if (item.indexOf('{tema}') > -1) {
                item = item.replace('{tema}', THEME_DIR);
                console.log(1.1, item);
            }
            if (item.indexOf('{base}') > -1) {
                item = item.replace('{base}', APP_DIR);
            }

            fs.access(item, fs.F_OK, (err) => {
                if (err) {
                    console.error(item, err);
                    return;
                }
            });

            entries[indice] = item;

        }

        return entries;

    };

};

module.exports = Jida;