<?php

namespace App\Console\Commands;

use App\Services\OpenGeoapify;
use Illuminate\Console\Command;
use App\Models\Geoapify;
use App\Models\City;

class GetGeoapify extends Command
{
    /**`
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getgeoapify';

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

    public function handle(OpenGeoapify $openGeoapify)
    {
        $cities = City::select('name', 'latitude', 'longitude')->get();
    
        foreach ($cities as $city) {
            $res = $openGeoapify->fetch([
                'lat' => $city['latitude'],
                'lon' => $city['longitude']
            ]);

            foreach ($res['features'] as $feature) {
                dump($feature);
                Geoapify::create([
                    'city' => $city['name'],
                    'name' => $feature['properties']['name'] ?? $feature['properties']['street'],
                    'address_line' => $feature['properties']['address_line2']
                ]);
            }
        }
        return Command::SUCCESS;
    }
}
