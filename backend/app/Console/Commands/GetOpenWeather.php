<?php

namespace App\Console\Commands;

use App\Services\OpenWeather;
use Illuminate\Console\Command;
use App\Models\Weather;
use App\Models\City;

class GetOpenWeather extends Command
{
    /**`
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getopenweather';

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

    public function handle(OpenWeather $openWeather)
    {
        $cities = City::pluck('name');
        foreach ($cities as $city) {
            $res = $openWeather->fetch([
                'type' => 'forecast',
                'city' => $city,
            ]);
            collect($res['list'])->each(function($item) use ($city){
                dump([
                    'dt' => $item['dt'],
                    'main' => $item['main'],
                    'weather' => $item['weather']
                ]);

                Weather::create([
                    'city' => $city,
                    'dt' => $item['dt'],
                    'main' => $item['main'],
                    'weather' => $item['weather']
                ]);
            });
        }
        return Command::SUCCESS;
    }
}
