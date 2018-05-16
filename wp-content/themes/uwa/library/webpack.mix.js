let mix = require("laravel-mix");
const glob = require('glob-all');

const ThemePathsArray = [
	path.join(__dirname, '../**/*.php'),
	path.join(__dirname, 'js/**/*.js')
];

mix
	.js("js/scripts.js", "js/build/production.min.js")
	.sass("scss/style.scss", "css/build/minified/style.css")
	.sass("scss/lp-style.scss", "css/build/minified/lp-style.css")
	.sass("scss/critical-interior.scss", "css/build/minified/critical-interior.css");


mix.browserSync({
	proxy: "onlineuwa.loc",
	notify: false,
	files: ["./css/build/minified/*.css", "./js/build/production.min.js"]
});

mix.autoload({
	vue: ["Vue", "window.Vue"],
	'jquery': ['$', 'window.jQuery', 'jQuery']
});

mix.options({
	// purifyCss: {
	// 	paths: glob.sync([
	// 			path.join(__dirname, '../**/**/*.php'),
	// 			path.join(__dirname, 'js/**/*.js')
	// 	]),
	// 	purifyOptions: {
	// 		minify: true,
	// 		info: true,
	// 		whitelist: []
	// 	}
	// },
	processCssUrls: false
});


mix
	.copy("fonts","css/build/fonts")
	.copy("node_modules/fontfaceobserver/fontfaceobserver.js", "js/build/fontfaceobserver.js")
	.copy("node_modules/owl.carousel/dist/assets/owl.carousel.min.css", "css/build/minified/owl.carousel.min.css")
	.copy([
		"node_modules/priority-nav/dist/priority-nav.min.js",
		"node_modules/owl.carousel/dist/owl.carousel.min.js"
	], "js/libs");

mix.disableNotifications();
