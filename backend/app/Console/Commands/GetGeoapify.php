<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Geoapify;
use App\Services\OpenGeoapify;
use Illuminate\Console\Command;

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
        $categories = ['tourism.sights', 'catering.restaurant'];
        foreach ($cities as $city) {
            foreach ($categories as $category) {
                $res = $openGeoapify->fetch([
                    'category' => $category,
                    'lat' => $city['latitude'],
                    'lon' => $city['longitude'],
                ]);

                foreach ($res['features'] as $feature) {
                    dump($feature);
                    Geoapify::create([
                        'city' => $city['name'],
                        'name' => $feature['properties']['name'] ?? $feature['properties']['street'],
                        'address_line' => $feature['properties']['address_line2'],
                        'category' => $category,
                    ]);
                }
            }
        }

        return Command::SUCCESS;
    }
}
