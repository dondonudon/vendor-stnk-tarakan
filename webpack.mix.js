const mix = require('laravel-mix');

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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/jquery.nicescroll/dist/jquery.nicescroll.js',
        'node_modules/moment/moment.js',
    ],'public/general.js')
    .scripts([
        // 'node_modules/@fortawesome/fontawesome-free/js/all.js',
        'node_modules/tabulator-tables/dist/js/tabulator.js',
        'public/vendor/daterangepicker-master/daterangepicker.js',
        'node_modules/datatables.net/js/jquery.dataTables.js',
        'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
        'node_modules/sweetalert2/dist/sweetalert2.js',
        'node_modules/numeral/src/numeral.js',
        'node_modules/cleave.js/dist/cleave.js',
        'node_modules/select2/dist/js/select2.js',
    ], 'public/plugin.js')
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        // 'node_modules/@fortawesome/fontawesome-free/css/all.css',
        'node_modules/tabulator-tables/dist/css/bootstrap/tabulator_bootstrap4.css',
        'public/vendor/daterangepicker-master/daterangepicker.css',
        'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
        'node_modules/sweetalert2/dist/sweetalert2.css',
        'node_modules/select2/dist/css/select2.css',
    ], 'public/plugin.css');
