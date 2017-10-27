const gulp = require('gulp');
const browserSync = require('browser-sync');

const conf = require('../gulp.conf');

gulp.task('scripts', scripts);

function scripts() {
    return gulp.src(conf.path.src('**/*.js'))
        .pipe(gulp.dest(conf.path.tmp()))
        .pipe(browserSync.stream());
};