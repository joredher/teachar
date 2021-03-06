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
    .js('resources/assets/js/ucomponents.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.browserSync('http://localhost:8000');

// let cssLoaders = require('url-loader');
// module.exports = {
//     module:{
//         rules:[
//             {
//                 test: /\.(png|jpg|gif)$/,
//                 use: [
//                     {
//                         loader: 'url-loader',
//                         options: {
//                             limit: 8192,
//                             name:'[name].[hash:7].[ext]'
//                         }
//                     }
//                 ]
//             }
//         ]
//     }
// };

