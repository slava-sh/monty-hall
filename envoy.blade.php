@include('vendor/autoload.php')
@setup
    Dotenv::load('.', '.env');

    $host     = env('DEPLOY_HOST');
    $app_root = env('DEPLOY_APP_ROOT');
@endsetup

@servers(['host' => $host])

@task('deploy', ['on' => 'host'])
    set -ex
    cd {{ $app_root }};

    php artisan down
    php artisan cache:clear

    git pull
    find storage -type d -exec chmod 777 {} +

    ./composer.phar install --no-interaction --no-dev --prefer-dist --optimize-autoloader

    php artisan config:cache
    php artisan route:cache
    php artisan optimize
    php artisan migrate --force

    npm install --quiet
    ./node_modules/.bin/bower install --quiet
    ./node_modules/.bin/gulp --production

    php artisan up
@endtask
