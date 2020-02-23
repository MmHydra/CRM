<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use app\Services\FacebookHandler;
class FacebookHandlerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
            //    $this->app->bind('App\Services\FacebookHandler', function(){
           //     return new FacebookHandler;
       // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // App::bind('facebookHandler',function() {
        // return new App\Services\FacebookHandler;
        // });

    }
}
