<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BuildFacebookUrlProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('buildFacebookUrl', 'App\Services\BuildFacebookUrl');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
