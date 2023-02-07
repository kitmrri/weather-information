<?php

namespace App\Console\Commands;

use App\Services\WeatherInterfaces;
use Illuminate\Console\Command;

class OpenWeather extends Command
{
    /**`
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openweather {type} {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Daily';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(WeatherInterfaces $openWeather)
    {
        $res = $openWeather->fetch([
            'type' => 'weather',
            'city' => 'Tokyo',
        ]);

        return Command::SUCCESS;
    }
}
