const gulp = require('gulp');
const HubRegistry = require('gulp-hub');
const browserSync = require('browser-sync');
const exec = require('child_process').exec;
const conf = require('./conf/gulp.conf');

// Load some files into the registry
const hub = new HubRegistry(['./conf/gulp_tasks/*.js']);

gulp.task('injectAll', gulp.series(gulp.parallel('styles', 'scripts'), 'inject'));
gulp.task('build', gulp.series('partials', gulp.parallel('injectAll', 'other'), 'build'));
gulp.task('rebuild', gulp.series('clean', 'build'));
gulp.task('serve', gulp.series('injectAll', 'browsersync', 'watch'));