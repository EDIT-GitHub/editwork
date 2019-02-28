var gulp = require('gulp');
var minify = require('gulp-minify-css');
var rename = require('gulp-rename');

gulp.task('minify-css', function (done) {
	//gulp.src('style.css') 
    gulp.src(['css/*.css', '!css/font-awesome.min.css'])
        .pipe(minify())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('dist/css'));
        done();
});
