var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var minifycss = require('gulp-minify-css');

gulp.task('css', function() {
   return gulp.src('app/assets/sass/main.scss')
   		.pipe(plumber())
    	.pipe(sass({errLogToConsole: true, precision: 10}))
       	.pipe(autoprefixer('last 10 version'))
       	.pipe(gulp.dest('public/css'));
});

gulp.task('vendor_sass', function() {
   return gulp.src('app/assets/vendor/stylesheets/bootstrap.scss')
       	.pipe(plumber())
        .pipe(sass({errLogToConsole: true, precision: 10}))
        .pipe(autoprefixer('last 10 version'))
        .pipe(rename('vendor.min.css'))
        .pipe(minifycss())
        .pipe(gulp.dest('public/css'));
});

gulp.task('watch', function() {
   gulp.watch('app/assets/sass/**/*.scss', ['css']);
   gulp.watch('app/assets/vendor/stylesheets/**/**/*.scss', ['vendor_sass'])
});

gulp.task('default', ['css', 'vendor_sass', 'watch']);