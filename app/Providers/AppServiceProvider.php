<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @inheritDoc
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            return new Client(config('services.wunder'));
        });
    }

    /**
     * @inheritDoc
     */
    public function provides()
    {
        return [
            Client::class,
        ];
    }
}
