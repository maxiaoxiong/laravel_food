var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    // mix.less('app.less');
    // mix.less('admin-lte/AdminLTE.less');
    // mix.less('bootstrap/bootstrap.less');
    mix.styles(['bootstrap.css','AdminLTE.css','skin-blue.css','blue.css','main-crop.css',
    'croppic.css','bootstrap-datetimepicker.min.css','select2.min.css','bootstrap-timepicker.css']);
    mix.scripts(['jQuery-2.1.4.min.js','bootstrap.min.js','app.min.js','vue.min.js']);
});
