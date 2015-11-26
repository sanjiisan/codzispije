var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

gulp.task('style', function () {
    gulp.src('web/sass/**/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('web/css'))
        .on('error', function (err) {
            this.emit('end');
        });
});

//Watch task
gulp.task('watch-style', function () {
    gulp.watch('web/sass/**/*.scss', ['style']);
});

//Watch task
gulp.task('default', ['style', 'watch-style']);
