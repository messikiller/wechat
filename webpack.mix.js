let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/assets/js/app.js', 'public/js')
    .styles([
        'node_modules/weui/dist/style/weui.min.css',
        'node_modules/ionicons201/css/ionicons.min.css'
    ], 'public/css/home.css')
    .copy('node_modules/ionicons201/fonts/*', 'public/fonts/')

;
   // .sass('resources/assets/sass/app.scss', 'public/css');
