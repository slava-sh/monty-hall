var elixir = require('laravel-elixir');

process.env.DISABLE_NOTIFIER = true;
elixir.config.sourcemaps = false;

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
