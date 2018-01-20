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

    // begin home pages assets
    .js('resources/assets/js/app.js', 'public/js')
    .styles([
        'node_modules/weui/dist/style/weui.min.css',
        'node_modules/ionicons201/css/ionicons.min.css'
    ], 'public/css/home.css')
    .copy('node_modules/ionicons201/fonts/*', 'public/fonts/')

    // begin admin pages assets
    .styles([
        'resources/assets/css/admin_layout.js'
    ], 'public/css/admin_layout.css')
    .js('resources/assets/js/admin.js', 'public/js/admin.js')

;
   // .sass('resources/assets/sass/app.scss', 'public/css');
