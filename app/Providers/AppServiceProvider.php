<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use App\Models\Tag;

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

        $this->app->singleton(App\Services\PortalStatistics::class, function () {
            return new App\Services\PortalStatistics();
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

            $view->with([
                'articleTagsCloud' => Tag::articleTagsCloud(),
                'newsTagsCloud' => Tag::newsTagsCloud(),
            ]);
        });

        Blade::if('admin', function () {
            if (auth()->user()) {
                return auth()->user()->isAdmin();
            }
        });

        Paginator::useBootstrap();
    }
}
