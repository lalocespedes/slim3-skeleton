var gulp = require('gulp'),
    php = require('gulp-connect-php');

gulp.task('php', function () {
    php.server({ base: 'public', port: 8010, keepalive: true });
});
