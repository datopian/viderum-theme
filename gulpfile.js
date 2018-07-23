var gulp = require('gulp');
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');

// The default Gulp.js task
gulp.task('default', ['icons', 'js', 'sass', 'watch']);

// Compile sass into CSS & auto-inject into browsers
gulp.task("sass", function () {
    return gulp.src('assets/scss/*.scss')
            // .pipe(sourcemaps.init())
            .pipe(sass().on('error', sass.logError))
            .pipe(cleanCSS({
                compatibility: 'ie11'
            }))
            .pipe(autoprefixer({
                browsers: [
                    "last 5 versions",
                    "ie >= 11"
                ]
            }))
            // .pipe(sourcemaps.write())
            .pipe(gulp.dest('assets/css'));
});

// Move the javascript files into our /src/js folder
gulp.task("js", function () {
    return gulp
            .src([
                "node_modules/bootstrap/dist/js/bootstrap.min.js",
                "node_modules/jquery/dist/jquery.min.js",
                "node_modules/popper.js/dist/umd/popper.min.js"
            ])
            .pipe(gulp.dest("assets/js"));
});

// Copy Material Design icons to assets/fonts/
gulp.task('icons', function () {
  return gulp.src([
      'node_modules/material-design-icons/iconfont/*'
    ])
    .pipe(gulp.dest('assets/fonts'));
});

// Watch for LESS and JS file changes
gulp.task("watch", function () {
    gulp.watch(["assets/scss/**/*.scss"], ["sass"]);
    gulp.watch(['assets/js/**/*.js'], ['js']);
});
