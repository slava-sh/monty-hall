process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.less();
    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.js',
        'app.js',
    ], 'public/js/app.js');
    mix.version([
        'css/app.css',
        'js/app.js',
    ]);
});
