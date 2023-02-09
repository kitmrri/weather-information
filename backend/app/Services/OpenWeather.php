<?php

namespace App\Services;

use Illuminate\Support\Facades\Http as Client;

class OpenWeather implements ApiInterfaces
{
    public function getConfig(): array
    {
        return config('services.openweather');
    }

    public function fetch(array $params): array
    {
        $config = $this->getConfig();
        $baseUrl = $config['base_url'];
        $type = $params['type'];
        $url = sprintf('%s/%s', $baseUrl, $type);

        $response = Client::withToken($config['key'])->timeout(30)->get($url, [
            'q' => $params['city'],
            'appid' => $config['key'],
            'units' => 'metric',

        ]);

        return $response->json();
    }
}
