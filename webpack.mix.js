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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')

mix.scripts([
    'resources/assets/js/libs/custom.js',
    'resources/assets/js/libs/material.min.js',
    'resources/assets/js/libs/moment.min.js',
    'resources/assets/js/libs/nouislider.min.js',
    'resources/assets/js/libs/bootstrap-datetimepicker.js',
    'resources/assets/js/libs/bootstrap-selectpicker.js',
    'resources/assets/js/libs/bootstrap-tagsinput.js',
    'resources/assets/js/libs/jasny-bootstrap.min.js',
    'resources/assets/js/libs/material-kit.min.js',
    'resources/assets/js/libs/jquery.flexisel.js',
], 'public/js/all.js')
    
    .styles('resources/assets/css/libs/material-kit.css','public/css/all.css');
