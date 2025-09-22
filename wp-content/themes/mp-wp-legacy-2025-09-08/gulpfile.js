const gulp = require('gulp'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    css_nano = require('gulp-cssnano'),
    rename = require('gulp-rename'),
    babel = require('gulp-babel'),
    sourcemaps = require('gulp-sourcemaps'),
    notify = require('gulp-notify'),
    plumber = require('gulp-plumber');

const assetsDir = 'assets';

function watchJs() {
    gulp.watch([assetsDir + '/js/src/*.js'], gulp.parallel(jsTask));
}

function watchCss() {
    gulp.watch([assetsDir + '/css/src/**/*.scss'], gulp.parallel(cssTask));
}

function cssTask() {
    return gulp.src(assetsDir + '/css/src/base.scss')
        .pipe(plumber({errorHandler: notify.onError("Klaida: <%= error.message %>")}))
        .pipe(sass(
            {
                sourceComments: 'map',
                sourceMap: 'sass',
                imagePath: 'images'
            }
        ))
        .pipe(css_nano({zindex: false, autoprefixer: true}))
        .pipe(rename('prod.css'))
        .pipe(gulp.dest(assetsDir + '/css/'))
}

function jsTask() {
    return gulp.src(assetsDir + '/js/src/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('prod.js'))
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(uglify())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(assetsDir + '/js/'))
}

gulp.task('default', gulp.parallel(cssTask, jsTask, watchJs, watchCss));
gulp.task('compile', gulp.series(cssTask, jsTask));