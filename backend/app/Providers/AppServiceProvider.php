<?php

namespace App\Providers;

use App\Http\Controllers\Api\GeoapifyController;
use App\Http\Controllers\Api\WeatherController;
use App\Services\ApiInterfaces;
use App\Services\OpenGeoapify;
use App\Services\OpenWeather;
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
        // $this->app->bind(ApiInterfaces::class, OpenWeather::class);
        $this->app->when(WeatherController::class)
            ->needs(ApiInterfaces::class)
            ->give(OpenWeather::class);

        $this->app->when(GeoapifyController::class)
            ->needs(ApiInterfaces::class)
            ->give(OpenGeoapify::class);
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
