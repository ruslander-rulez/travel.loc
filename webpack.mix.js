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

mix.disableNotifications();
mix.copy("resources/assets/dashboard/", "public/dashboard");

mix
    .js('resources/assets/js/components/ship/app.js', 'public/js/ship.js')
    .js('resources/assets/js/components/client/app.js', 'public/js/client.js')
    .js('resources/assets/js/components/booking/app.js', 'public/js/booking.js')
    .js('resources/assets/js/components/settings/app.js', 'public/js/settings.js')
    .sass('resources/assets/sass/app.scss', 'public/css');
