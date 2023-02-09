<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'dt';
    }

    protected $table = 'weather';

    protected $fillable = [
        'city',
        'main',
        'weather',
        'dt',
    ];

    // {
    //     "dt": 1676030400,
    //     "main": {
    //         "temp": 277.29,
    //         "feels_like": 273.03,
    //         "temp_min": 277.29,
    //         "temp_max": 277.29,
    //         "pressure": 1020,
    //         "sea_level": 1020,
    //         "grnd_level": 1015,
    //         "humidity": 90,
    //         "temp_kf": 0
    //     },
    //     "weather": [
    //         {
    //             "id": 804,
    //             "main": "Clouds",
    //             "description": "overcast clouds",
    //             "icon": "04n"
    //         }
    //     ],
    //     "clouds": {
    //         "all": 100
    //     },
    //     "wind": {
    //         "speed": 5.82,
    //         "deg": 340,
    //         "gust": 9.25
    //     },
    //     "visibility": 10000,
    //     "pop": 0.88,
    //     "sys": {
    //         "pod": "n"
    //     },
    //     "dt_txt": "2023-02-10 12:00:00"
    // },

    protected $casts = [
        'main' => 'array',
        'weather' => 'array',
    ];
}
