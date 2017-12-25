'use strict';
 
var gulp = require('gulp');
var sass = require('gulp-sass');
 
gulp.task('sass', function () {
  return gulp.src('./raw-assets/scss/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('./assets/css'));
});

gulp.task('watch', function () {
  gulp.watch('./raw-assets/scss/*.scss', ['sass', 'watch']);
});

// gulp.task('default',['sass', 'watch']);
gulp.task('serve:before', ["watch"]);