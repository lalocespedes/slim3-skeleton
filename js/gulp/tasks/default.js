var gulp = require('gulp'),
    browserSync = require('browser-sync');

var reload = browserSync.reload;

gulp.task('default', ['browser-sync', 'bower', 'icons', 'styles'], function () {

    // gulp.watch(['resources/**/*.twig'], [reload]);
    gulp.watch(['./js/src/**/*.js'], ['injectAngular']);
    gulp.watch(['./js/src/**/*.html'], ['injectAngular']);
    
});
