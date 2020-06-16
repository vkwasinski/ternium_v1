var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var cssnano = require('gulp-cssnano');

gulp.task('styles', function() {
    return gulp.src(['./resources/assets/sass/**/*.scss'])
        .pipe(plumber({
            errorHandler: function(error) {
                console.log(error.message);
                this.emit('end');
            }
        }))
        .pipe(sass())
        .pipe(concat('style_dev.css'))
        .pipe(gulp.dest('./assets/css/'))
        .pipe(cssnano({zindex: false}))
        .pipe(concat('style_min.css'))
        .pipe(gulp.dest('./assets/css/'));
});

gulp.task('scripts', function() {
    return gulp.src(['./resources/assets/js/**/*.js'])
        .pipe(plumber({
            errorHandler: function(error) {
                console.log(error.message);
                this.emit('end');
            }
        }))
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./assets/js/'));
});

gulp.task('default', function() {
    gulp.watch('./resources/assets/sass/**/*.scss', gulp.series('styles'));
    gulp.watch('./resources/assets/js/**/*.js',      gulp.series('scripts'));
});