var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rev = require('gulp-rev');
var revDel = require('rev-del');
var inject = require('gulp-inject');
var browserSync = require('browser-sync');

gulp.task('vendor', function() {
	gulp.src([
        './bower_components/angular/angular.js',
        './bower_components/angular-ui-router/release/angular-ui-router.js',
        './bower_components/angular-sanitize/angular-sanitize.js',
        './bower_components/angular-resource/angular-resource.js',
        './bower_components/ngstorage/ngStorage.js'
    ])
	.pipe(concat('vendor.js'))
	.pipe(uglify())
    .pipe(rev())
	.pipe(gulp.dest('./public/scripts'))
    .pipe(rev.manifest('rev-manifiest-vendor'))
    .pipe(revDel({ dest: './public/scripts' }))
    .pipe(gulp.dest('./public/scripts'));

    // Inject
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
