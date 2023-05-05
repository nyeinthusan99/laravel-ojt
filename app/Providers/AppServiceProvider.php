<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\Dao\UserDaoInterface','App\Dao\UserDao');
        $this->app->bind('App\Contracts\Dao\PostDaoInterface','App\Dao\PostDao');

        $this->app->bind('App\Contracts\Services\UserServiceInterface','App\Services\UserService');
        $this->app->bind('App\Contracts\Services\PostServiceInterface','App\Services\PostService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
