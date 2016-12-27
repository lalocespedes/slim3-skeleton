var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var rename = require("gulp-rename");
var rev = require('gulp-rev');
var revDel = require('rev-del');
var angularFilesort = require('gulp-angular-filesort');
var del = require('del');

gulp.task('angular', function() {

    return gulp.src([
        './js/src/**/*.js'
    ])
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(angularFilesort())
        .pipe(concat('scripts.js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify({mangle: false}))
        .pipe(rev())
        .pipe(gulp.dest('./public/scripts'))
        .pipe(rev.manifest('rev-manifiest-angular'))
        .pipe(revDel({ dest: './public/scripts' }))
        .pipe(gulp.dest('./public/scripts'));
});
