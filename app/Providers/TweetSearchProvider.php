<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TweetSearchProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('TweetSearch', 'App\Services\TweetSearch');
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
