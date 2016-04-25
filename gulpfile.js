/**
 * MEH gulp
 */

// 'use strict';

var gulp = require('gulp');
var runSequence = require('run-sequence');
var gulpLoadPlugins = require('gulp-load-plugins');
var postcss = require('gulp-postcss');
var autoPrefixer = require('autoprefixer');
var postcssFlex = require('postcss-flexibility');
var postScss = require('postcss-scss');
var preCss = require('precss');
var perfectionist = require('perfectionist');

var $ = gulpLoadPlugins();

var AUTOPREFIXER_BROWSERS = [
	'ie >= 10',
	'ie_mob >= 10',
	'last 2 ff versions',
	'last 2 chrome versions',
	'last 2 edge versions',
	'last 2 safari versions',
	'last 2 opera versions',
	'ios >= 7',
	'android >= 4.4',
	'bb >= 10'
];

var POSTCSS_PLUGINS = [
	preCss(),
	autoPrefixer({
		browsers: AUTOPREFIXER_BROWSERS
	}),
	//styleFmt()
	perfectionist({
		cascade: false
	})
];

// Compile and Automatically Prefix Stylesheets (production)
gulp.task('styles', function () {
	gulp.src('assets/src/arch.css')
		.pipe($.sourcemaps.init())
		.pipe(postcss(POSTCSS_PLUGINS, {syntax: postScss}))
		.pipe($.concat('arch.css'))
		.pipe(gulp.dest('assets/css'))
		.pipe($.if('*.css', $.cssnano()))
		.pipe($.concat('arch.min.css'))
		.pipe($.size({title: 'styles'}))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('assets/css'))
});

// Concatenate And Minify JavaScript
// gulp.task('scripts', function () {
// 	gulp.src(SOURCESJS)
// 	.pipe(babel({
// 		"presets": ["es2015"],
// 		"only": [
// 			"src/js/arch.js"
// 		]
// 	}))
// 	.pipe($.concat('arch.js'))
// 	.pipe(gulp.dest('assets/js'))
// 	.pipe($.uglify())
// 	.pipe($.concat('arch.min.js'))
// 	.pipe(gulp.dest('assets/js'))
// 	.pipe($.size({title: 'scripts'}))
// });


// Build production files, the default task
gulp.task('default', function (cb) {
	runSequence('styles', cb);
});
