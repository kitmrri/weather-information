<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\Weather;

class WeatherController extends Controller
{
    private function fetchWeatherData(Request $request, string $type) {
        $selectedCity = $request->input('selectedCity');
        if (!$selectedCity) {
            return response()->json(['error' => 'No selected city provided']);
        }

        $cacheKey = "{$type}_weather_data_{$selectedCity}";
        $weatherData = Cache::get($cacheKey);
        if ($weatherData) {
            error_log('Have cache');
            return response()->json($weatherData);
        } else {
            error_log('No cache');
            $weatherData = file_get_contents("https://api.openweathermap.org/data/2.5/{$type}?q={$selectedCity}&appid=" . env('VITE_WEATHER_API_KEY'));
            $weatherData = json_decode($weatherData);

            Cache::put($cacheKey, $weatherData, 60);
            return response()->json($weatherData);
        }
    }

    public function fetchCurrentWeatherData(Request $request) {
        return $this->fetchWeatherData($request, 'weather');
    }

    public function fetchForecastData(Request $request) {
        return $this->fetchWeatherData($request, 'forecast');
    }
}
