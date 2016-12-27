var gulp = require('gulp');

var config = {
    sassPath: './resources/sass',
    bowerDir: './bower_components'
}

gulp.task('icons', function () {
    return gulp.src(config.bowerDir + '/components-font-awesome/fonts/**.*')
        .pipe(gulp.dest('public/fonts'));
});
