function ModuleBuilder(module) {
    'use strict';

    const Path = require('path');
    const fs = require('fs');

    const {promisify} = require('util');
    fs.readFile = promisify(fs.readFile);
    fs.writeFile = promisify(fs.writeFile);
    const processors = ['jsx', 'js'];

    let dirname;
    this.loadModule = async (module, location, outputPath) => {

        dirname = location;
        try {

            let code = '';
            let path = location.split('Aplicacion')[1].split(Path.sep);
            //todo: get from a correctly way the main app path;

            let jumps = '';
            for (let step in path) jumps += '../';

            code += `import {React} from '${jumps}htdocs/modules/libs/react.development.js';\n`;
            code += `import {ReactDOM} from '${jumps}htdocs/modules/libs/react-dom.development.js';\n`;

            for (let prop of processors) {

                if (!module.hasOwnProperty(prop)) continue;

                let typeCode = '';
                let folder = typeof module[prop] === 'string' ? module[prop] : module[prop].path;

                if (!folder) {
                    throw `The processor "${prop}" has not a path defined.`;
                }

                const dir = `${dirname}${Path.sep}${folder}`;

                if (!fs.existsSync(dir)) continue;

                const files = new (require('./files'))(dir, prop);

                for (let file of files.files) {
                    typeCode += await fs.readFile(file.path, {'encoding': 'utf8'});
                    typeCode += '\n';
                }

                if (prop === 'jsx') {
                    const compiled = require('@babel/core').transform(typeCode, {
                        plugins: ['@babel/plugin-transform-react-jsx']
                    });
                    typeCode = compiled.code;
                }

                code += typeCode;
                code += '\n';

            }//'

            fs.writeFile(outputPath, code);
        }
        catch (e) {
            console.error('error writing', e);
        }

    }
}

module.exports = ModuleBuilder;