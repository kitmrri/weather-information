<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OpenWeather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, OpenWeather $openWeather)
    {
        $weather = $openWeather->fetch([
            'type' => 'weather',
            'city' => $request->get('city'),
        ]);

        return response()->json($weather);
    }
}
