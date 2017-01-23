/**
 * task for minifying the custom css file
 */

'use strict';

// Require the needed packages
var gulp      = require('gulp'),
    concat    = require('gulp-concat'),
    imagemin  = require('gulp-imagemin'),
    less      = require('gulp-less'),
    minifyCSS = require('gulp-minify-css'),
    notify    = require('gulp-notify'),
    uglify    = require('gulp-uglify'),
    util      = require('gulp-util'),
    watch     = require('gulp-watch');

/**
 * TASKS
 */
gulp.task('styles', function () {
  gulp.src('./assets/styles/cts.less')
    .pipe(less())
    .pipe(gulp.dest('./css/'))
    .pipe(concat('cts.css'))
    .pipe(minifyCSS())
    .pipe(gulp.dest('./css/'));
});


gulp.task('scripts', function () {
  gulp.src('./assets/scripts/**/*.js')
//    .pipe(uglify())
    .pipe(gulp.dest('./js/'));
});


gulp.task('images', function () {
    gulp.src('./assets/images/**/*')
      .pipe(imagemin())
      .pipe(gulp.dest('./img/'));
  });



/**
 *  run all tasks with:
 *  $ gulp assets
 */
gulp.task('assets', function(){
    gulp.run('scripts');
    gulp.run('styles');
    gulp.run('images');

    gulp.watch('./assets/styles/**/*.less', function() {
      gulp.run('styles');
    });

    gulp.watch('./assets/scripts/**/*.js', function() {
      gulp.run('scripts');
    });

    gulp.watch('./assets/images/**/*', function() {
      gulp.run('images');
    });
  }
);


/**
 * Default gulp task will run all tasks.
 */
gulp.task('default', function(){
    gulp.run('assets');
  }
);
