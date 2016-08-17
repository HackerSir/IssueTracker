var elixir = require('laravel-elixir');

/*
   |--------------------------------------------------------------------------
   | Elixir Asset Management
   |--------------------------------------------------------------------------
   |
   | Elixir provides a clean, fluent API for defining some basic Gulp tasks
   | for your Laravel application. By default, we are compiling the Sass
   | file for our application, as well as publishing vendor resources.
   |
   */
var gulp = require('gulp');
var build = require('./semantic/tasks/build')
var exec = require('child_process').exec;
var rimraf = require('rimraf');

gulp.task('build', 'Builds all files from source', build);

gulp.task('default', ['build'],function(){
	process.chdir('./public/semantic');
	rimraf('components', function(err){
		if (err) {
			console.log(err);
		}
	});
	rimraf('themes/basic', function(err){
		if (err) {
			console.log(err);
		}
	});
	rimraf('themes/github', function(err){
		if (err) {
			console.log(err);
		}
	});
	rimraf('semantic.css', function(err){
		if (err) {
			console.log(err);
		}
	});
	rimraf('semantic.js', function(err){
		if (err) {
			console.log(err);	
		}
	});
});
