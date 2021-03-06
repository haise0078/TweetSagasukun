<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TweetSaveProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\TweetSaveInterface', 'App\Services\TweetSave');
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
