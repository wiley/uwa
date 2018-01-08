let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
// mix.setPublicPath('path/to/public');

mix.options({ processCssUrls: false });

mix.js('js/scripts.js', 'js/build/production.min.js')
  .sass('scss/style.scss', 'css/build/minified/style.css');

mix.disableNotifications();

mix.browserSync({
    proxy: 'uwa-gulp.dev',
    notify: false,
    files: ["./css/build/minified/*.css", "./js/build/production.min.js"]
})


// JS
mix.copy('node_modules/fontfaceobserver/fontfaceobserver.js', 'js/build/fontfaceobserver.js');
mix.copy('node_modules/mixitup/dist/mixitup.min.js', 'js/libs/mixitup.min.js');
mix.copy('node_modules/priority-nav/dist/priority-nav.min.js', 'js/libs/priority-nav.min.js');
mix.copy('node_modules/owl.carousel/dist/owl.carousel.min.js', 'js/libs/owl.carousel.min.js');

// CSS
mix.copy('node_modules/owl.carousel/dist/assets/owl.carousel.min.css', 'css/build/minified/owl.carousel.min.css');


// mix.autoload({
//   'jquery': ['$', 'window.jQuery', 'jQuery'],
// });
// mix.sass('scss/style.scss', 'dist/');
// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.less(src, output);
// mix.stylus(src, output);
// mix.browserSync('uwa.loc');
// mix.autoload({
//    jquery: ['$', 'window.jQuery']
// });
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
