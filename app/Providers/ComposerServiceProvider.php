<?php namespace App\Providers;

use View;
use Route;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

    public function boot() {
        View::composer('*', function($view) {
            $route   = Route::currentRouteName() ?: 'error';
            $page_id = 'page-' . str_replace('.', '-', $route);
            $view->with(compact('route', 'page_id'));
        });
    }

    public function register() {
    }
}
