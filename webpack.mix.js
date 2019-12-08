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
    .js('resources/assets/js/components/place/app.js', 'public/js/place.js')
    .js('resources/assets/js/components/hotel/app.js', 'public/js/hotel.js')
    .js('resources/assets/js/components/restaurant/app.js', 'public/js/restaurant.js')
    .js('resources/assets/js/components/client/app.js', 'public/js/client.js')
    .js('resources/assets/js/components/booking/app.js', 'public/js/booking.js')
    .js('resources/assets/js/components/book/app.js', 'public/js/book.js')
    .js('resources/assets/js/components/index/app.js', 'public/js/index.js')
    .js('resources/assets/js/components/settings/app.js', 'public/js/settings.js')
    .sass('resources/assets/sass/app.scss', 'public/css');


/*
 |--------------------------------------------------------------------------
 | Mix Assets with Metronic theme
 |--------------------------------------------------------------------------
 */

mix
    .scripts([
        "resources/assets/web-theme/plugins/jquery/jquery.min.js",
        "resources/assets/web-theme/plugins/bootstrap/js/bootstrap.bundle.min.js",
        "resources/assets/web-theme/js/adminlte.min.js",
    ], 'public/web/layout-scripts.js')
    .styles([
        "resources/assets/web-theme/css/docs.css",
        "resources/assets/web-theme/css/highlighter.css",
        "resources/assets/web-theme/css/adminlte.min.css",
    ], "public/web/layout-styles.css")
    .copy("resources/assets/web-login-page", "public/web/login-page");