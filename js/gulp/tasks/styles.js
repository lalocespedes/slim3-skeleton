var gulp = require('gulp'),
    concat = require('gulp-concat'),
    sass = require('gulp-ruby-sass'),
    notify = require('gulp-notify');
    
gulp.task('styles', function() {

    //var options = {};
    //options.manifest = process.cwd();
    //var manifest = path.join(options.manifest, 'rev-manifest.json');

    return gulp.src([
        './bower_components/bootswatch-dist/css/bootstrap.css',
        './bower_components/components-font-awesome/css/font-awesome.css'
    ])
        .pipe(concat('styles.css'))
        //.pipe(rev())
        //.pipe(gulp.dest('./public/styles'))
        //.pipe(rev.manifest())
        //.pipe(revDel({dest: './public/styles'}))
        .pipe(gulp.dest('./public/css'));
});
