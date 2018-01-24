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
        'resources/assets/css/admin_layout.css'
    ], 'public/css/admin_layout.css')
    .styles([
        'semantic/dist/semantic.min.css',
        'resources/assets/css/admin.css'
    ], 'public/css/admin.css')
    .js('resources/assets/js/admin.js', 'public/js/admin.js')
    .scripts([
        //'node_modules/jquery/dist/jquery.min.js',
        'semantic/dist/semantic.min.js',
        'public/js/admin.js'
    ], 'public/js/admin.js')
    .copy('semantic/dist/themes/', 'public/css/themes/')


;
   // .sass('resources/assets/sass/app.scss', 'public/css');
