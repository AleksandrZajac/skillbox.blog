<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(App\Services\TagsSynchronizer::class, function () {
            return new App\Services\TagsSynchronizer();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {

            $view->with('tagsCloud', \App\Models\Tag::tagsCloud());
        });

        Blade::if('admin', function () {
            if (auth()->user()) {
                return auth()->user()->isAdmin();
            }
        });

        Paginator::useBootstrap();
    }
}
