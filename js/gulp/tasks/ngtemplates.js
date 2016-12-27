var gulp = require('gulp');
var rev = require('gulp-rev');
var revDel = require('rev-del');
var templateCache = require('gulp-angular-templatecache');
var minifyHTML = require('gulp-minify-html');

gulp.task('ngtemplates', function() {

    return gulp.src('./js/src/**/*.html')
        .pipe(minifyHTML({ empty: true, quotes: true }))
        .pipe(templateCache({ module: 'App'}))
        .pipe(rev())
        .pipe(gulp.dest('./public/scripts/'))
        .pipe(rev.manifest('rev-manifiest-ngtemplates'))
        .pipe(revDel({ dest: './public/scripts' }))
        .pipe(gulp.dest('./public/scripts/'));
});
