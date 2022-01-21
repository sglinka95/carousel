<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Yaxint\Client;

class YaxintServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client(
                uri: config('services.yaxint.uri'),
                token: config('services.yaxint.token')
            );
        });
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
