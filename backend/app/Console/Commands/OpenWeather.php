<?php

namespace App\Console\Commands;

use App\Services\WeatherInterfaces;
use Illuminate\Console\Command;
use App\Models\Weather;


class OpenWeather extends Command
{
    /**`
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openweather';

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
            'type' => 'forecast',
            'city' => 'Tokyo',
        ]);
        collect($res['list'])->each(function($item){
            // var_dump($item['dt']);
            Weather::create($item);
        });
        return Command::SUCCESS;
    }
}
