const gulp = require('gulp');
const browserSync = require('browser-sync');
const angularTemplatecache = require('gulp-angular-templatecache');
const htmlmin = require('gulp-htmlmin');

const conf = require('../gulp.conf');


gulp.task('partials', templates);

function templates() {
  return gulp.src(conf.path.src('app/*.html'))
    .pipe(htmlmin())
    .pipe(angularTemplatecache('templateCacheHtml.js', {
        module: conf.ngModule,
        root: 'app'
    }))
    .pipe(gulp.dest(conf.path.tmp()))
    .pipe(browserSync.stream());
};