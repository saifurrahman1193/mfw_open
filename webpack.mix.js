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


 
      //   <link rel="stylesheet" href="{{ elixir('scss/_robot.scss') }}">


      // <link rel="stylesheet" href="{{ elixir('scss/_reset.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_card.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_demo.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_fonts.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_footer.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_functions.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_layouts.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_misc.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_navbar.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_sidebar.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_typography.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_utilities.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_variables.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/_widget-grid.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/dashboard.scss') }}">
      // <link rel="stylesheet" href="{{ elixir('scss/style.scss') }}"> 