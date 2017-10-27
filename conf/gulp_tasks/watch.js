const gulp = require('gulp');
const browserSync = require('browser-sync');
const conf = require('../gulp.conf');

gulp.task('watch', watch);

function watch(done) {
    gulp.watch(conf.path.src('index.html'), gulp.series('inject'));

    gulp.watch([
        conf.path.src('app/**/*.js')
    ], gulp.series('scripts'));

    gulp.watch([
        conf.path.src('styles/*.scss')
    ], gulp.series('styles'));

    gulp.watch([
        conf.path.src('app/**/*.html')
    ], gulp.series('partials'));

    done();
}