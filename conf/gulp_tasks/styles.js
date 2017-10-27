const gulp = require('gulp');
const browserSync = require('browser-sync');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');

const conf = require('../gulp.conf');

gulp.task('styles', styles);

function styles() {
    const processors = [
        autoprefixer(),
        //cssnano(),
    ];

    return gulp.src(conf.path.src('index.scss'))
      .pipe(sourcemaps.init())
      .pipe(sass({ outputStyle: 'expanded' })).on('error', conf.errorHandler('Sass'))
      .pipe(postcss(processors)).on('error', conf.errorHandler('Autoprefixer'))
      .pipe(sourcemaps.write())
      .pipe(gulp.dest(conf.path.tmp()))
      .pipe(browserSync.stream());
};