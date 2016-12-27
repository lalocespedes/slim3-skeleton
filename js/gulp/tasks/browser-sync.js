var gulp = require('gulp'),
    browserSync = require('browser-sync');

gulp.task('browser-sync', ['php'], function () {

    browserSync({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: true,
        notify: false
    });
});
