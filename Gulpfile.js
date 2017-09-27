var gulp = require('gulp');
var pump = require('pump');
var util = require('gulp-util');


///
// Dev Functionality
///

gulp.task('dev:watch', function() {
    var livereload = require('gulp-livereload');

    livereload.listen({
        quiet: true
    });

    gulp.watch([
        'assets/css/themes/*.yml',
        'assets/css/**/*.scss',
        '!assets/css/vendor/**/*.scss',
    ], ['sass:dev']);

    gulp.watch([
        'web/assets/js/**/*.js',
        'web/assets/css/styles.css',
        'app/Resources/views/**/*.html.twig',
        'src/AppBundle/*.php',
    ]).on('change', function (file) {
        livereload.changed(file);

        util.log(util.colors.yellow('File changed: ' + file.path));
    });
});


///
// Sass Functionality
///

var sass = require('gulp-sass');
var eyeglass = require('eyeglass');
var combineMq = require('gulp-combine-mq');
var moduleImporter = require('sass-module-importer');

gulp.task('sass:dev', function (cb) {
    var sourcemaps = require('gulp-sourcemaps');

    pump([
        gulp.src('assets/css/styles.scss'),
        sourcemaps.init(),
        sass(eyeglass({
            importer: moduleImporter(),
            outputStyle: 'compact'
        })),
        combineMq({
            beautify: true
        }),
        sourcemaps.write('.'),
        gulp.dest('web/assets/css')
    ], cb);
});

gulp.task('sass:dist', function (cb) {
    var cssmin = require('gulp-cssmin');
    var postcss = require('gulp-postcss');
    var unprefix = require('postcss-unprefix');
    var removePrefixes = require('postcss-remove-prefixes');

    pump([
        gulp.src('assets/css/styles.scss'),
        sass(eyeglass({
            importer: moduleImporter(),
            outputStyle: 'compressed'
        })),
        combineMq({
            beautify: false
        }),
        postcss([
            unprefix(),
            removePrefixes()
        ]),
        cssmin({
            processImport: false,
            mediaMerging: false
        }),
        gulp.dest('web/assets/css')
    ], cb);
});
gulp.task('sass:test', function(cb) {
    var mocha = require('gulp-mocha');

    pump([
        gulp.src('assets/css/tests/test.js', { read: false }),
        mocha()
    ], cb);
});


///
// Gulp Tasks
///

gulp.task('dev', ['sass:dev', 'dev:watch']);
gulp.task('dist', ['sass:dist']);

gulp.task('default', ['dev']);
