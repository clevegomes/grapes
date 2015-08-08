var elixir = require('laravel-elixir');

/*
 |----------------------------------------------------------------
 | Have a Drink!
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */

var paths = {
	'jquery': './vendor/bower_components/jquery/',
	'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/'
}

elixir(function(mix) {
	mix.sass("app.scss", 'public_html/css/all.css', {includePaths: [paths.bootstrap + 'stylesheets/']})
		.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public_html/fonts')
		.scripts([
			paths.jquery + "dist/jquery.js",
			paths.bootstrap + "javascripts/bootstrap.js"
			//,'./public_html/js/app.js'
		], './public_html/js/');
});