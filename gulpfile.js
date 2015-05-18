process.env.DISABLE_NOTIFIER = true;

var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.less();
    mix.scripts([
        'app.js',
    ], 'public/js/app.js');
    mix.version([
        'css/app.css',
        'js/app.js',
    ]);
});
