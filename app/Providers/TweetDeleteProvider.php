<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TweetDeleteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\TweetDeleteInterface', 'App\Services\TweetDelete');
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
