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
//    .sass('resources/sass/app.scss', 'public/css');

   mix.js(['resources/js/app.js',
      // 'public/theme/assets/libs/jquery-2.2.3.min.js',
	   'public/theme/assets/libs/bootstrap-4.3.1/js/bootstrap.min.js',
	   // 'public/theme/assets/libs/select2/js/select2.min.js',
	   'public/theme/assets/libs/slick/slick.min.js',
	   'public/theme/assets/js/custom.js',
      'public/theme/assets/js/intlTelInput.js',

      ], 'public/js')
      .autoload({
      jquery: ['$', 'window.jQuery']
      })
      .sass('resources/sass/app.scss', 'public/css');

   if (mix.inProduction()) {
      mix.version();
   } else {
      mix.webpackConfig({
            devtool: 'source-map'
      })
      .sourceMaps()
   }
     