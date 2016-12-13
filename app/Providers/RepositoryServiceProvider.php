<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //服务
        $this->app->bind(
            'App\Repositories\Contracts\UserInterface',
            'App\Repositories\Eloquent\UserServiceRepository'
        );
    }
}
