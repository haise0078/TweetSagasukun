<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TwitterConnectionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('TwitterConnection', 'App\Http\Components\TwitterConnection');
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
