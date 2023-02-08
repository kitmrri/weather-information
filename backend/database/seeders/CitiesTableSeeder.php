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
            'Tokyo', 'Yokohama', 'Kyoto', 'Osaka', 'Sapporo', 'Nagoya',
        ];

        foreach ($cities as $city) {
            City::create(['name' => $city]);
        }
    }
}
