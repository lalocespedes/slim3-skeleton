var gulp = require('gulp'),
    php = require('gulp-connect-php'),
    browserSync = require('browser-sync'),
    concat = require('gulp-concat'),
    sass = require('gulp-ruby-sass'),
    notify = require('gulp-notify'),
    bower = require('gulp-bower');

var config = {
    sassPath: './resources/sass',
    bowerDir: './bower_components'
}

var reload = browserSync.reload;

gulp.task('php', function () {
    php.server({ base: 'public', port: 8010, keepalive: true });
});
gulp.task('browser-sync', ['php'], function () {

    browserSync({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: true,
        notify: false
    });

});

gulp.task('default', ['browser-sync', 'bower', 'icons', 'styles'], function () {

    gulp.watch(['resources/**/*.twig'], [reload]);
    
});

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
 
gulp.task('bower', function() {

    return bower()
    .pipe(gulp.dest(config.bowerDir));

});

gulp.task('icons', function () {
    return gulp.src(config.bowerDir + '/components-font-awesome/fonts/**.*')
        .pipe(gulp.dest('public/fonts'));
});
