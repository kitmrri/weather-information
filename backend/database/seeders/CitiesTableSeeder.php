<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Tokyo', 'latitude' => 35.6895, 'longitude' => 139.6917],
            ['name' => 'Yokohama', 'latitude' => 35.4437, 'longitude' => 139.6388],
            ['name' => 'Kyoto', 'latitude' => 35.0116, 'longitude' => 135.7680],
            ['name' => 'Osaka', 'latitude' => 34.6937, 'longitude' => 135.5022],
            ['name' => 'Sapporo', 'latitude' => 43.0643, 'longitude' => 141.3469],
            ['name' => 'Nagoya', 'latitude' => 35.1801, 'longitude' => 136.9066],
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city['name'], 'latitude' => $city['latitude'], 'longitude' => $city['longitude']]);
        }
    }
}
