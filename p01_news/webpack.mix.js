const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('public/assmin/js/my-js.js', 'public/backend/js');
mix.postCss('public/assmin/css/mycss.css', 'public/backend/css');

mix.combine([
  'public/assmin/css/mycss.css',
  'public/assmin/css/custom.min.css',
  'public/assmin/css/toastr.css'
],'public/backend/css/combine-all.css');