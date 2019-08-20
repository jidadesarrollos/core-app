let gulp = require('gulp');
let concat = require('gulp-concat');
let minifyCSS = require('gulp-minify-css');
let autoprefixer = require('gulp-autoprefixer');
//let uglify = require('gulp-uglify')
let uglify = require('gulp-uglify-es').default;

let jida = new (require('./tasks/jida'))('default');

gulp.task('css', async () => {

    jida.read().prepare('css');

    gulp.src(jida.entries)
        .pipe(minifyCSS())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(concat('styles.min.css'))
        .pipe(gulp.dest('./htdocs/css/dist'));

});

gulp.task('js', () => {

    jida.read().prepare('js');
    console.log(jida.entries);
    gulp.src(jida.entries)
        .pipe(concat('jd.bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./htdocs/js/dist'));

});
