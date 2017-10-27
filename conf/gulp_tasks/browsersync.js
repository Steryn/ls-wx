const gulp = require('gulp');
const browserSync = require('browser-sync');
const browserSyncConf = require('../browsersync.conf');

const browserSyncTmpConf = browserSyncConf.tmp;
const browserSyncDistConf = browserSyncConf.dist;

gulp.task('browsersync', browserSyncServe);
gulp.task('browsersync:dist', browserSyncDist);

function browserSyncServe(done) {
    browserSync.init(browserSyncTmpConf());
    done();
};

function browserSyncDist(done) {
    browserSync.init(browserSyncDistConf());
    done();
};