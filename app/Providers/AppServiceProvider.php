<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        $this->app->bind(
            'App\Interfaces\BusesLineInterface',
            'App\Repositories\BusesLineRepository'
        );
        $this->app->bind(
            'App\Interfaces\BusesLineStopInterface',
            'App\Repositories\BusesLineStopRepository'
        );
        $this->app->bind(
            'App\Interfaces\BusesLineRouteInterface',
            'App\Repositories\BusesLineRouteRepository'
        );
    }
}
