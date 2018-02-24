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
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.browserSync('http://localhost:8000');
// const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
// mix.webpackConfig({
//     plugins : [
//         new BrowserSyncPlugin({
//             open: 'external',
//             host: 'localhost',
//             proxy: 'localhost',
//             files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php']
//         })
//     ]
// });