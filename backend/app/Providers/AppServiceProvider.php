<?php

namespace App\Providers;

use App\Services\OpenWeather;
use App\Services\WeatherInterfaces;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherInterfaces::class, OpenWeather::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
