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
        'node_modules/jquery/dist/jquery.min.js',
        'semantic/dist/semantic.min.js',
        'public/js/admin.js'
    ], 'public/js/admin.js')
    .copy('semantic/dist/themes/', 'public/css/themes/')

    // begin log viewer assets
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/font-awesome/css/font-awesome.min.css',
        'node_modules/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css'
    ], 'public/css/log-viewer.css')
    .scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/jquery-migrate/dist/jquery-migrate.min.js ',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/moment/min/moment-with-locales.min.js',
        'node_modules/chart.js/dist/Chart.min.js',
        'node_modules/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
    ], 'public/js/log-viewer.js')
    .copy('node_modules/font-awesome/fonts/*', 'public/fonts/')
    .copy('node_modules/bootstrap/fonts/*', 'public/fonts/')

;
   // .sass('resources/assets/sass/app.scss', 'public/css');
