<?php

namespace App\Services;

use Illuminate\Support\Facades\Http as Client;

class OpenGeoapify implements ApiInterfaces
{
    public function getConfig(): array
    {
        return config('services.geoapify');
    }

    public function fetch(array $params): array
    {
        $config = $this->getConfig();

        $response = Client::withToken($config['key'])->timeout(30)->get($config['base_url'], [
            'categories' => $params['category'],
            'bias' => 'proximity:'.$params['lon'].','.$params['lat'],
            'limit' => '5',
            'apiKey' => $config['key'],
        ]);

        return $response->json();
    }
}
