const gulp = require('gulp');
const browserSync = require('browser-sync');
const gulpInject = require('gulp-inject');

const conf = require('../gulp.conf');

gulp.task('inject', inject);

function inject() {
    return gulp.src(conf.path.src('index.html'))
        .pipe(gulpInject(gulp.src([
            conf.path.tmp('vendor/*.js')
        ], { read: false }), {
            name: 'head',
            ignorePath: [conf.paths.src, conf.paths.tmp],
            addRootSlash: false
        }))
        .pipe(gulpInject(gulp.src([
            conf.path.tmp('**/*.js'),
        ], { read: false }), {
            ignorePath: [conf.paths.src, conf.paths.tmp],
            addRootSlash: false
        }))
        .pipe(gulp.dest(conf.path.tmp()))
        .pipe(browserSync.stream());
};