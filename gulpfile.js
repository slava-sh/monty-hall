var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.less();
    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.js',
        '../../../bower_components/bootstrap/dist/js/bootstrap.js',
    ], 'public/js/app.js');
    mix.version([
        'css/app.css',
        'js/app.js',
    ]);
});
