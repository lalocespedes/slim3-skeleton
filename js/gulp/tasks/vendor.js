var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var inject = require('gulp-inject');
var browserSync = require('browser-sync');

gulp.task('vendor', function() {
	gulp.src([
        './bower_components/angular/angular.js',
        './bower_components/angular-ui-router/release/angular-ui-router.js'
    ])
	.pipe(concat('vendor.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./public/scripts'));

    gulp.src('./resources/views/dashboard/dashboard.twig')
    .pipe(inject(gulp.src(['./public/scripts/vendor*.js'], {
            read: false
        }),
        {
            name: 'vendor',
            addRootSlash: true,
            ignorePath: 'public'
        }
    ))
    .pipe(gulp.dest('./resources/views/dashboard/'));

    return browserSync.reload();

});
