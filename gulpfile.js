var elixir = require('laravel-elixir');

process.env.DISABLE_NOTIFIER = true;
elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.less();
    mix.styles([
        'bower_components/normalize.css/normalize.css',
        'public/css/app.css',
    ], 'public/css/all.css', './');
    mix.scripts([
        'app.js',
    ], 'public/js/app.js');
    mix.version([
        'css/all.css',
        'js/app.js',
    ]);
});
