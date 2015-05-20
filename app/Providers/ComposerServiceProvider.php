<?php namespace App\Providers;

use View;
use Route;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    public function boot() {
        View::composer('*', function($view) {
            $page_id = 'page-' . str_replace('.', '-', Route::currentRouteName());
            $view->withPageId($page_id);
        });
    }

    public function register() {
    }
}
