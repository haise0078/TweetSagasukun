<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TweetSavceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('TweetSave', 'App\Services\TweetSave');
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
