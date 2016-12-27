var gulp = require('gulp');
var inject = require('gulp-inject');
var browserSync = require('browser-sync');

gulp.task('injectAngular', ['angular', 'ngtemplates'], function() {

    gulp.src('./resources/views/dashboard/dashboard.twig')
        .pipe(inject(gulp.src(['./public/scripts/scripts*.js', './public/scripts/templates*.js'], {
                read: false
            })
            , {
                addRootSlash: true,
                ignorePath: 'public'
            }
        ))
        .pipe(gulp.dest('./resources/views/dashboard/'));

    browserSync.reload();

});
