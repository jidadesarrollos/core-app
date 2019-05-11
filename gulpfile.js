var gulp = require('gulp'),
    minifyCSS = require('gulp-minify-css'),
    concatCss = require('gulp-concat-css'),
    concatJS = require('gulp-concat'),
    notify = require('gulp-notify'),
    uglify = require('gulp-uglify');

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

let count = 0;
var nameTask = [];
archivostema.forEach(function (archivo) {
    let url = archivo.slice(0, -9);
    let tema = JSON.parse(fs.readFileSync(url + 'tema.json', 'utf8'));
    let libJS = {};
    let libCSS = {};
    count++;

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
            libJS.app = listaJS;
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
            libCSS.app = listaCSS;
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
        for (let fileEnd in libJS) {
            nameTask.push(`tema${count}-${fileEnd}-js`);
            gulp.task(`tema${count}-${fileEnd}-js`, function () {

                gulp.src(libJS[fileEnd])
                    .pipe(concatJS(`${fileEnd}.bundle.js`))
                    .pipe(gulp.dest(url + '/htdocs/js/'))
                    .pipe(notify('compilados archivos js'));

            });
        }

    }

    if (libCSS !== {}) {
        for (let fileEnd in libCSS) {
            nameTask.push(`tema${count}-${fileEnd}-css`);

            gulp.task(`tema${count}-${fileEnd}-css`, function () {
                return gulp.src(libCSS[fileEnd])
                    .pipe(concatCss(`${fileEnd}.bundle.css`))
                    .pipe(gulp.dest(`${url}htdocs/css/`))
                    .pipe(notify('compilados archivos css'));

            });
        }
    }
});

console.log(nameTask);

gulp.task('default', nameTask);


