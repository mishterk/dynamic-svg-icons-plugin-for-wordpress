let mix = require('laravel-mix');

mix.setPublicPath('./assets/build');

mix.js('assets/src/js/dsvgi.js', 'js')
    .sass('assets/src/scss/dsvgi.scss', 'css');

if (mix.inProduction()) {
    mix.sourceMaps();
}