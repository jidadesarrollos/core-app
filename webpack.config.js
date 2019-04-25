const path = require('path');
const fs = require('fs');
const read = require('fs-readdir-recursive');

const ExtractTextPlugin = require('extract-text-webpack-plugin');

let archivos = read(__dirname);
let archivostema = [];
let webpackTask = [];

for (let archivo in archivos) {
    archivos[archivo].endsWith('tema.json') ? archivostema.push(archivos[archivo]) : null;
}

archivostema.forEach(function (archivo) {
    let url = archivo.slice(0, -9);
    let tema = JSON.parse(fs.readFileSync(url + 'tema.json', 'utf8'));
    let libJS = {};
    let libCSS = {};

    for (let group in tema.dev.js) {
        if (typeof tema.dev.js[group] === 'string') {
            let listaJS = [];
            for (let lib in tema.dev.js) {
                let def = tema.dev.js[lib];
                if (def.startsWith('{tema}')) {
                    def = def.replace('{tema}', './' + url.slice(0, -1));
                }
                else if (def.startsWith('{base}')) {
                    def = def.replace('{base}', '.');
                }
                else {
                    def = '.' + def;
                }
                listaJS.push(def);
            }
            libJS['app'] = listaJS;
            break;
        }
        else {
            libJS[group] = [];
            for (let lib in tema.dev.js[group]) {
                let def = tema.dev.js[group][lib];

                if (def.startsWith('{tema}')) {
                    def = def.replace('{tema}', './' + url.slice(0, -1));
                }
                else if (def.startsWith('{base}')) {
                    def = def.replace('{base}', '.');
                }
                else {
                    def = '.' + def;
                }
                libJS[group].push(def);
            }
        }

    }

    for (let group in tema.dev.css) {
        if (typeof tema.dev.css[group] === 'string') {
            let listaCSS = [];
            for (let lib in tema.dev.css) {
                let def = tema.dev.css[lib];
                if (def.startsWith('{tema}')) {
                    def = def.replace('{tema}', './' + url.slice(0, -1));
                }
                else if (def.startsWith('{base}')) {
                    def = def.replace('{base}', '.');
                }
                else {
                    def = '.' + def;
                }
                listaCSS.push(def);
            }
            libCSS['app'] = listaCSS;
            break;
        }
        else {
            libCSS[group] = [];
            for (let lib in tema.dev.css[group]) {
                let def = tema.dev.css[group][lib];

                if (def.startsWith('{tema}')) {
                    def = def.replace('{tema}', './' + url.slice(0, -1));
                }
                else if (def.startsWith('{base}')) {
                    def = def.replace('{base}', '.');
                }
                else {
                    def = '.' + def;
                }
                libCSS[group].push(def);
            }
        }

    }

    if (libJS !== {}) {
        webpackTask.push({
            mode: 'none',
            output: {
                path: path.resolve(__dirname, url + '/htdocs/js'),
                filename: '[name].bundle.js'
            },
            entry: libJS
        });
    }

    if (libCSS !== {}) {
        webpackTask.push({
            entry: libCSS,
            resolveLoader: {
                modules: [
                    'node_modules'
                ]
            },
            mode: 'production',
            module: {
                rules: [
                    {
                        test: /\.css$/,
                        use: ExtractTextPlugin.extract({
                            loader: 'css-loader',
                            options: {
                                minimize: true
                            }
                        })
                    }

                ]
            },
            plugins: [
                new ExtractTextPlugin({
                    path: path.resolve(__dirname, url + '/htdocs/js'),
                    filename: '[name].bundle.css'
                })

            ]
        })
    }
});

fs.writeFileSync('./data.json', JSON.stringify(webpackTask), 'utf-8');

module.exports = webpackTask[0];
