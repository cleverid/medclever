var gulp = require('gulp'),
    stylus = require('gulp-stylus'),
    minifyCss = require("gulp-minify-css"),
    concatCss = require("gulp-concat-css"),
    rename = require("gulp-rename"),
    notify = require("gulp-notify"),
    spritesmith  = require('gulp.spritesmith'),
    plumber = require('gulp-plumber');

var folderStylus = './frontend/web/stylus/',
    folderCss = './frontend/web/css/',
    folderImages = './frontend/web/image/',
    folderImagesForSprite = './frontend/web/stylus/sprite/',
    fileStylusTemplate = folderStylus + "stylus.template.sprite";

gulp.task('style', function () {
    return gulp.src(folderStylus + 'style.styl')
            .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
            .pipe(stylus())
            .pipe(rename("style.css"))
            .pipe(gulp.dest(folderCss))
            .pipe(minifyCss(""))
            .pipe(rename("style.min.css"))
            .pipe(gulp.dest(folderCss))
            .pipe(notify("Done css minified!"));
});

gulp.task('sprite', function() {
    var spriteData =
        gulp.src(folderImagesForSprite + "*.*")
            .pipe(spritesmith({
                imgName: 'sprite.png',
                cssName: 'sprite.styl',
                cssFormat: 'stylus',
                algorithm: 'binary-tree',
                cssTemplate: fileStylusTemplate,
                cssVarMap: function(sprite) {
                    sprite.name = 's-' + sprite.name
                }
            }));

    spriteData.img.pipe(gulp.dest(folderImages));
    spriteData.css.pipe(gulp.dest(folderStylus));
});

gulp.task('watch', function(){
    gulp.watch(folderImagesForSprite + "*.*", ['sprite']);
    gulp.watch(folderStylus + "*.*", ['style']);
});

gulp.task("default", ['sprite', 'style', 'watch']);