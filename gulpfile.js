var gulp = require('gulp'),
    stylus = require('gulp-stylus'),
    minifyCss = require("gulp-minify-css"),
    rename = require("gulp-rename");

var folderStylus = './frontend/web/stylus/',
    folderCss = './frontend/web/css/';

gulp.task('style', function () {
    return gulp.src(folderStylus + 'style.styl')
            .pipe(stylus())
            .pipe(rename("style.css"))
            .pipe(gulp.dest(folderCss))
            .pipe(minifyCss(""))
            .pipe(rename("style.min.css"))
            .pipe(gulp.dest(folderCss));
            //.pipe(notify("Done css minified!"));
});

gulp.task('watch', function(){
    gulp.watch(folderStylus + "*.*", ['style']);
});

gulp.task("default", ['style', 'watch']);