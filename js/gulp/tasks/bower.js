var gulp = require('gulp'),
    bower = require('gulp-bower');

var config = {
    sassPath: './resources/sass',
    bowerDir: './bower_components'
}
 
gulp.task('bower', function() {

    return bower()
    .pipe(gulp.dest(config.bowerDir));

});
