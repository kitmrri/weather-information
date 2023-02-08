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

        // $aa = file_get_contents("https://api.geoapify.com/v2/places?categories=tourism.sights&bias=proximity:139.6503,35.6762&limit=20&apiKey=" . env('GEOAPIFY_API_KEY'));
        // $aa = json_decode($aa);
        return response()->json($weather);
    }
}
